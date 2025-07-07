const express = require('express');
const router = express.Router();
const SavingsController = require('../../controllers/SavingsController');
const EntryController = require('../../controllers/EntryController');
const AuthMiddleware = require('../../middleware/AuthMiddleware');

router.use(AuthMiddleware);

router.get('/entry/saving', SavingsController.list);
router.get('/entry/saving/:uuid', EntryController.show);
router.post('/entry/saving', SavingsController.create);
router.put('/entry/saving/:uuid', SavingsController.update);
router.delete('/entry/saving/:uuid', SavingsController.delete);

module.exports = router;
