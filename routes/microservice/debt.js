const express = require('express');
const router = express.Router();
const DebtController = require('../../controllers/DebtController');
const AuthMiddleware = require('../../middleware/AuthMiddleware');

router.use(AuthMiddleware);

router.get('/payees', DebtController.payeeList);
router.get('/debits', DebtController.getDebits);
router.delete('/debt/:uuid', DebtController.deleteDebt);

module.exports = router;
