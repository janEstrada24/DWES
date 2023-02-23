const categoriaService = require('../services/categoriaService');

const getAllCategories = (req, res, next) => {
    const { mode } = req.query;
    try {
        const allCategories = categoriaService.getAllCategories({ mode });
        res.send({ status: "OK", data: allCategories });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
}

const getOneCategoria = (req, res) => {
    const {
        params: { categoriaId },
    } = req;

    if (!categoriaId) {
        res.status(400).send({ 
            status: "FAILED", 
            data: { error: "Missing categoriaId" } 
        });
        return;
    }

    try {
        const categoria = categoriaService.getOneCategoria(categoriaId);
        res.send({ status: "OK", data: categoria });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

const createOneCategoria = (req, res) => {
    const { body } = req;

    if(
        !body.nom ||
        !body.iva
    ) {
        res.status(400).send({
            status: "FAILED",
            data: {
                error: "One of the following keys is missing or is empty in request body: nom, iva"
            }}
        );
        return;
    }

    const newCategoria = {
        nom: body.nom,
        iva: body.iva,
    };

    try {
        const createdCategoria = categoriaService.createOneCategoria(newCategoria);
        res.send({ status: "OK", data: createdCategoria });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

const updateOneCategoria = (req, res) => {
    const {
        params: { categoriaId },
        body,
    } = req;

    if (!categoriaId) {
        res
            .status(400)
            .send({ 
                status: "FAILED", 
                data: { error: "Parameter ':categoriaId' cannot be empty" }
            });
    }

    try {
        const updatedCategoria = categoriaService.updateOneCategoria(categoriaId, body);
        res.send({ status: "OK", data: updatedCategoria });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

const deleteOneCategoria = (req, res) => {
    const {
        params: { categoriaId },
    } = req;

    if (!categoriaId) {
        res
            .status(400)
            .send({ 
                status: "FAILED", 
                data: { error: "Parameter ':categoriaId' cannot be empty" }
            });
    }

    try {
        categoriaService.deleteOneCategoria(categoriaId);
        res.send({ status: "OK" });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

module.exports = {
    getAllCategories,
    getOneCategoria,
    createOneCategoria,
    updateOneCategoria,
    deleteOneCategoria,
};
