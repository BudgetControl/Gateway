const express = require('express');
const router = express.Router();
const ProxyController = require('../controllers/ProxyController');

/**
 * WEBHOOK GATEWAY
 */
router.post('/cache-invalidate', ProxyController.handleWebhook);

module.exports = router;
