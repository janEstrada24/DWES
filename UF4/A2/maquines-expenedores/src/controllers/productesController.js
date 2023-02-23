const producteService = require('../services/producteService');

const getAllProductes = (req, res, next) => {
    const { mode } = req.query;
    try {
        const allProductes = producteService.getAllProductes({ mode });
        res.send({ status: "OK", data: allProductes });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
}

const getOneProducte = (req, res) => {
    const {
        params: { producteId },
    } = req;

    if (!producteId) {
        res.status(400).send({ 
            status: "FAILED", 
            data: { error: "Missing producteId" } 
        });
        return;
    }

    try {
        const producte = producteService.getOneProducte(producteId);
        res.send({ status: "OK", data: producte });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
}

const createOneProducte = (req, res) => {
    const { body } = req;

    if(
        !body.nom ||
        !body.tipus ||
        !body.preu ||
        !body.categoria
    ) {
        res.status(400).send({
            status: "FAILED",
            data: {
                error: "One of the following keys is missing or is empty in request body: nom, tipus, preu, categoria"
            }}
        );
        return;
    }

    const newProducte = {
        nom: body.nom,
        tipus: body.tipus,
        preu: body.preu,
        categoria: body.categoria,
    };

    try {
        const createdProducte = producteService.createOneProducte(newProducte);
        res.send({ status: "OK", data: createdProducte });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

const updateOneProducte = (req, res) => {
    const {
        body,
        params: { producteId },
    } = req;

    if (!producteId) {
        res
            .status(400)
            .send({ 
                status: "FAILED", 
                data: { error: "Parameter ':producteId' cannot be empty" }
            });
    }

    try {
        const updatedProducte = producteService.updateOneProducte(producteId, body);
        res.send({ status: "OK", data: updatedProducte });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

const deleteOneProducte = (req, res) => {
    const {
        params: { producteId },
    } = req;

    if (!producteId) {
        res
            .status(400)
            .send({
                status: "FAILED",
                data: { error: "Parameter ':producteId' cannot be empty" }
            });
    }

    try {
        producteService.deleteOneProducte(producteId);
        res.status(204).send({ status: "OK" });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

module.exports = {
    getAllProductes,
    getOneProducte,
    createOneProducte,
    updateOneProducte,
    deleteOneProducte,
};