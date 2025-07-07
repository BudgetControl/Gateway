const express = require('express');
const router = express.Router();
const ProxyController = require('../controllers/ProxyController');

// Rotta per il monitoring
router.get('/monitor/:ms', ProxyController.handleMonitor);

// Catch-all route che ridirige tutto al ProxyController
router.all('*', ProxyController.proxyRequest.bind(ProxyController));

module.exports = router;
const entryRoutes = require('./microservice/entry');
const debtRoutes = require('./microservice/debt');
const labelRoutes = require('./microservice/label');
const coreRoutes = require('./microservice/core');
const savingsRoutes = require('./microservice/savings');

// Use microservice routes
router.use('/', authenticationRoutes);
router.use('/', statsRoutes);
router.use('/', workspaceRoutes);
router.use('/', budgetRoutes);
router.use('/', searchengineRoutes);
router.use('/', walletRoutes);
router.use('/', entryRoutes);
router.use('/', debtRoutes);
router.use('/', labelRoutes);
router.use('/', coreRoutes);
router.use('/', savingsRoutes);

router.get('/monitor/:ms', BaseController.monitor);

module.exports = router;
