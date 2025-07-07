const express = require('express');
const router = express.Router();
const ExpensesController = require('../../controllers/ExpensesController');
const IncomingController = require('../../controllers/IncomingController');
const TransferController = require('../../controllers/TransferController');
const PayeeController = require('../../controllers/PayeeController');
const EntryController = require('../../controllers/EntryController');
const EntryModelController = require('../../controllers/EntryModelController');
const PlannedEntryController = require('../../controllers/PlannedEntryController');
const AuthMiddleware = require('../../middleware/AuthMiddleware');

router.use(AuthMiddleware);

// EXPENSE ROUTES
router.get('/entry/expense', ExpensesController.list);
router.get('/entry/expense/:uuid', EntryController.show);
router.post('/entry/expense', ExpensesController.create);
router.put('/entry/expense/:uuid', ExpensesController.update);

// INCOME ROUTES
router.get('/entry/income', IncomingController.list);
router.get('/entry/income/:uuid', EntryController.show);
router.post('/entry/income', IncomingController.create);
router.put('/entry/income/:uuid', IncomingController.update);

// TRANSFER ROUTES
router.get('/entry/transfer', TransferController.list);
router.get('/entry/transfer/:uuid', EntryController.show);
router.post('/entry/transfer', TransferController.create);
router.put('/entry/transfer/:uuid', TransferController.update);

// DEBIT ROUTES
router.get('/entry/debit', PayeeController.list);
router.get('/entry/debit/:uuid', EntryController.show);
router.post('/entry/debit', PayeeController.create);
router.put('/entry/debit/:uuid', PayeeController.update);

// DELETE ROUTES
router.delete('/entry/debit/:uuid', PayeeController.delete);
router.delete('/entry/income/:uuid', IncomingController.delete);
router.delete('/entry/expense/:uuid', ExpensesController.delete);
router.delete('/entry/transfer/:uuid', TransferController.delete);
router.delete('/entry/:uuid', EntryController.delete);
router.delete('/entry/model/:uuid', EntryModelController.delete);

// MODEL ROUTES
router.get('/entry/model', EntryModelController.list);
router.post('/entry/model', EntryModelController.create);
router.get('/entry/model/:uuid', EntryModelController.show);
router.put('/entry/model/:uuid', EntryModelController.update);

// PLANNED ENTRY ROUTES
router.get('/entry/planned', PlannedEntryController.list);
router.post('/entry/planned', PlannedEntryController.create);
router.get('/entry/planned/:uuid', PlannedEntryController.show);
router.put('/entry/planned/:uuid', PlannedEntryController.update);
router.delete('/entry/planned/:uuid', PlannedEntryController.delete);

// GENERIC ENTRY ROUTES
router.get('/entry/:uuid', EntryController.show);
router.put('/entry/:uuid', EntryController.update);
router.get('/entry', EntryController.list);

module.exports = router;
