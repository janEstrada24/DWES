const express = require("express");
const router = express.Router();
const maquinesController = require("../../controllers/maquinesController");

// Les rutes que tenen dos punts i un nom, són rutes dinàmiques

/**
 * @openapi
 * /api/v1/maquines:
 *  get:
 *    tags:
 *      - Maquines
 *    responses:
 *     200:
 *      description: Llista de totes les maquines	
 * 
 */
router.get("/", maquinesController.getAllMaquines);

/**
 * @openapi
 * /api/v1/maquines:
 *  get:
 *    tags:
 *      - Maquines
 *    responses:
 *     200:
 *      description: Llista una maquina
 * 
 */
router.get("/:maquinaId", maquinesController.getOneMaquina);

/**
 * @openapi
 * /api/v1/maquines:
 *  post:
 *    tags:
 *      - Maquines
 *    responses:
 *     200:
 *      description: Crea una maquina
 * 
 */
router.post("/", maquinesController.createOneMaquina);

/**
 * @openapi
 * /api/v1/maquines:
 *  delete:
 *    tags:
 *      - Maquines
 *    responses:
 *     200:
 *      description: Elimina una maquina
 * 
 */
router.delete("/:maquinaId", maquinesController.deleteOneMaquina);

module.exports = router;