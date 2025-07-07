const axios = require('axios');
const routesConfig = require('../config/routes');

class ProxyController {
    constructor() {
        this.routeMapping = {
            '/auth': 'auth',
            '/workspace': 'workspace',
            '/budgets': 'budget',
            '/budget': 'budget',
            '/find': 'searchengine',
            '/wallet': 'wallet',
            '/entry': 'entry',
            '/payees': 'debt',
            '/debits': 'debt',
            '/debt': 'debt',
            '/label': 'label',
            '/payment-types': 'core',
            '/currencies': 'core',
            '/categories': 'core',
            '/stats': 'stats',
            '/monitor': 'core'
        };
    }

    async proxyRequest(req, res) {
        try {
            const microservice = this.getMicroserviceFromPath(req.path);
            if (!microservice) {
                return res.status(404).json({ error: 'Microservice not found' });
            }

            const baseUrl = routesConfig[microservice];
            if (!baseUrl) {
                return res.status(500).json({ error: 'Microservice URL not configured' });
            }

            // Prepara i parametri della richiesta
            const requestConfig = {
                method: req.method,
                url: `${baseUrl}${req.path}`,
                headers: this.prepareHeaders(req),
                timeout: 30000
            };

            // Aggiungi query parameters
            if (Object.keys(req.query).length > 0) {
                requestConfig.params = req.query;
            }

            // Aggiungi body per POST/PUT/PATCH
            if (['POST', 'PUT', 'PATCH'].includes(req.method.toUpperCase())) {
                requestConfig.data = req.body;
            }

            // Esegui la richiesta al microservizio
            const response = await axios(requestConfig);

            // Ritorna la risposta
            res.status(response.status).json(response.data);

        } catch (error) {
            console.error('Proxy error:', error.message);
            
            if (error.response) {
                // Errore dal microservizio
                res.status(error.response.status).json(error.response.data);
            } else if (error.request) {
                // Errore di rete
                res.status(503).json({ error: 'Service unavailable' });
            } else {
                // Errore generico
                res.status(500).json({ error: 'Internal server error' });
            }
        }
    }

    getMicroserviceFromPath(path) {
        // Trova il microservizio basandosi sul path
        for (const [routePrefix, microservice] of Object.entries(this.routeMapping)) {
            if (path.startsWith(routePrefix)) {
                return microservice;
            }
        }
        return null;
    }

    prepareHeaders(req) {
        const headers = {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        };

        // Copia gli headers di autenticazione
        if (req.headers.authorization) {
            headers.Authorization = req.headers.authorization;
        }

        // Copia altri headers importanti
        if (req.headers['x-workspace-id']) {
            headers['X-Workspace-Id'] = req.headers['x-workspace-id'];
        }

        if (req.headers['user-agent']) {
            headers['User-Agent'] = req.headers['user-agent'];
        }

        return headers;
    }

    // Metodo specifico per webhook
    async handleWebhook(req, res) {
        try {
            if (req.path === '/cache-invalidate') {
                // Logica per invalidare la cache
                // Qui potresti chiamare un servizio di cache o gestire l'invalidazione
                res.status(200).json({ message: 'Cache invalidated successfully' });
            } else {
                res.status(404).json({ error: 'Webhook endpoint not found' });
            }
        } catch (error) {
            console.error('Webhook error:', error.message);
            res.status(500).json({ error: 'Internal server error' });
        }
    }

    // Metodo per il monitoring
    async handleMonitor(req, res) {
        try {
            const microservice = req.params.ms;
            const baseUrl = routesConfig[microservice];
            
            if (!baseUrl) {
                return res.status(404).json({ error: 'Microservice not found' });
            }

            const response = await axios.get(`${baseUrl}/health`, { timeout: 5000 });
            res.status(200).json({
                microservice,
                status: 'healthy',
                data: response.data
            });

        } catch (error) {
            res.status(503).json({
                microservice: req.params.ms,
                status: 'unhealthy',
                error: error.message
            });
        }
    }
}

module.exports = new ProxyController();
