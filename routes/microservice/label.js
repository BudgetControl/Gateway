const express = require('express');
const router = express.Router();
const LabelController = require('../../controllers/LabelController');
const AuthMiddleware = require('../../middleware/AuthMiddleware');

router.use(AuthMiddleware);

router.get('/label/list', LabelController.list);
router.put('/label/:label_id', LabelController.update);
router.post('/label/:label_id', LabelController.insert);
router.get('/label/:label_id', LabelController.show);
router.patch('/label/:label_id', LabelController.patch);
router.delete('/label/:label_id', LabelController.delete);

module.exports = router;
