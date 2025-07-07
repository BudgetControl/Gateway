import express from 'express';
import cors from 'cors';
import { decodeToken } from './jwtService.js';
import { validateCognitoToken } from './cognitoService.js';
import { logRequest } from './logger.js';
import apiRoutes from '../routes/api.js';

// Import ProxyController
const ProxyController = require('../controllers/ProxyController.js');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// Request logging middleware
app.use((req, res, next) => {
  logRequest(req);
  next();
});

// Authentication middleware
app.use('/api', async (req, res, next) => {
  const token = req.headers['x-bc-token'];
  const authHeader = req.headers['authorization'];

  if (!authHeader || !token) {
    return res.status(401).json({ error: 'Unauthorized' });
  }

  let decoded;
  try {
    decoded = decodeToken(token);
  } catch (err) {
    console.error('Invalid X-BC-Token:', err);
    return res.status(401).json({ error: 'Unauthorized' });
  }

  const accessToken = authHeader.replace('Bearer ', '');

  try {
    await validateCognitoToken(accessToken, decoded.username);
    req.user = decoded;
    req.accessToken = accessToken;
    next();
  } catch (err) {
    console.error('Cognito token invalid:', err);
    return res.status(401).json({ error: 'Unauthorized' });
  }
});

// Monitor endpoint (without auth)
app.get('/api/monitor/:ms', ProxyController.handleMonitor.bind(ProxyController));

// Webhook endpoints (without auth)
app.post('/webhook/*', ProxyController.handleWebhook.bind(ProxyController));

// All API routes proxied to microservices
app.use('/api', ProxyController.proxyRequest.bind(ProxyController));

// API Routes
app.use('/api', apiRoutes);

// Health check endpoint
app.get('/health', (req, res) => {
  res.json({ status: 'OK', message: 'Gateway is running' });
});

// Error handling middleware
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({ error: 'Something went wrong!' });
});

// 404 handler
app.use((req, res) => {
  res.status(404).json({ error: 'Not Found' });
});

// Start server
app.listen(PORT, () => {
  console.log(`Gateway server running on port ${PORT}`);
});

// Export for testing
export default app;
