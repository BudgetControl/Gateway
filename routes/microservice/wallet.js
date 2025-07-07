const express = require('express');
const router = express.Router();
const WalletController = require('../../controllers/WalletController');
const AuthMiddleware = require('../../middleware/AuthMiddleware');

router.use(AuthMiddleware);

router.get('/wallet/list', WalletController.list);
router.get('/wallet/show/:uuid', WalletController.show);
router.post('/wallet/create', WalletController.create);
router.put('/wallet/update/:uuid', WalletController.update);
router.delete('/wallet/:uuid', WalletController.delete);
router.patch('/wallet/restore/:uuid', WalletController.restore);
router.patch('/wallet/sorting/:uuid', WalletController.sorting);
router.patch('/wallet/archive/:uuid', WalletController.archive);

module.exports = router;
