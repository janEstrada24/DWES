const express = require("express");
const router = express.Router();
const productesController = require("../../controllers/productesController");

router.get("/", productesController.getAllProductes);

router.get("/:producteId", productesController.getOneProducte);

router.post("/", productesController.createOneProducte);

router.patch("/:producteId", productesController.updateOneProducte);

router.delete("/:producteId", productesController.deleteOneProducte);

module.exports = router;