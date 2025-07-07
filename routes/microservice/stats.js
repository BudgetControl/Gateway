const express = require('express');
const router = express.Router();
const StatsController = require('../../controllers/StatsController');
const ChartsController = require('../../controllers/ChartsController');
const AverageController = require('../../controllers/AverageController');
const AuthMiddleware = require('../../middleware/AuthMiddleware');
const CachingMiddleware = require('../../middleware/CachingMiddleware');

router.use(AuthMiddleware);

// STATS
router.get('/stats/incoming', StatsController.incoming);
router.get('/stats/find/incoming', StatsController.statsIncoming);
router.get('/stats/expenses', StatsController.expenses);
router.get('/stats/find/expenses', StatsController.statsExpenses);
router.get('/stats/total', StatsController.total);
router.get('/stats/wallets', StatsController.wallets);
router.get('/stats/health', StatsController.health);
router.get('/stats/total/planned', StatsController.totalPlanned);
router.post('/stats/entries', StatsController.entries);
router.get('/stats/debits', StatsController.debits);
router.get('/stats/debits/total-negative', StatsController.debitsTotalNegative);
router.get('/stats/debits/total-positive', StatsController.debitsTotalPositive);

// STATS CHART
router.get('/stats/chart/line/incoming-expenses', CachingMiddleware(60), ChartsController.incomingExpensesLineByDate);
router.get('/stats/chart/bar/expenses/category', CachingMiddleware(15), ChartsController.expensesCategoryBarByDate);
router.get('/stats/chart/bar/incoming/category', CachingMiddleware(15), ChartsController.incomingCategoryBarByDate);
router.get('/stats/chart/table/expenses/category', CachingMiddleware(15), ChartsController.expensesCategoryTableByDate);
router.get('/stats/chart/table/incoming/category', CachingMiddleware(15), ChartsController.incomingCategoryTableByDate);
router.get('/stats/chart/bar/expenses/label', CachingMiddleware(30), ChartsController.expensesLabelBarByDate);
router.get('/stats/chart/apple-pie/expenses/label', CachingMiddleware(30), ChartsController.expensesLabelApplePieByDate);

// STATS AVERAGE
router.get('/stats/average-expenses', CachingMiddleware(60), AverageController.averageExpenses);
router.get('/stats/average-incoming', CachingMiddleware(60), AverageController.averageIncoming);
router.get('/stats/average-savings', CachingMiddleware(60), AverageController.averageSavings);
router.get('/stats/total-loan-installments', CachingMiddleware(60), AverageController.totalLoanInstallmentsOfCurrentMonth);
router.get('/stats/total/planned/remaining', CachingMiddleware(60), AverageController.totalPlannedRemainingOfCurrentMonth);
router.get('/stats/total/planned/monthly', CachingMiddleware(60), AverageController.totalPlannedMonthly);

module.exports = router;
