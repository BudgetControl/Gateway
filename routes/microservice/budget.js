const express = require('express');
const router = express.Router();
const BudgetController = require('../../controllers/BudgetController');
const AuthMiddleware = require('../../middleware/AuthMiddleware');

router.use(AuthMiddleware);

router.get('/budgets', BudgetController.list);
router.get('/budget/:uuid', BudgetController.show);
router.post('/budget/create', BudgetController.create);
router.put('/budget/update/:uuid', BudgetController.update);
router.delete('/budget/:uuid', BudgetController.delete);
router.get('/budget/:uuid/expired', BudgetController.expired);
router.get('/budget/:uuid/exceeded', BudgetController.exceeded);
router.get('/budget/:uuid/status', BudgetController.status);
router.get('/budget/:uuid/stats', BudgetController.budgetStats);
router.get('/budgets/stats', BudgetController.budgetsStats);
router.get('/budget/:uuid/entry-list', BudgetController.entryList);

module.exports = router;
