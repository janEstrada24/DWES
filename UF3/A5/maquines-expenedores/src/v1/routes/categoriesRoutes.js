const express = require("express");
const router = express.Router();
const categoriesController = require("../../controllers/categoriesController");

router.get("/", categoriesController.getAllCategories);

router.get("/:categoriaId", categoriesController.getOneCategoria);

router.post("/", categoriesController.createOneCategoria);

router.patch("/:categoriaId", categoriesController.updateOneCategoria);

router.delete("/:categoriaId", categoriesController.deleteOneCategoria);

module.exports = router;