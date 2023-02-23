const express = require("express");
const router = express.Router();
const estocsController = require("../../controllers/estocsController");

router.get("/", estocsController.getAllEstocs);

router.get("/:estocId", estocsController.getOneEstoc);

router.post("/", estocsController.createOneEstoc);

router.patch("/:estocId", estocsController.updateOneEstoc);

router.delete("/:estocId", estocsController.deleteOneEstoc);

module.exports = router;
