const recordService = require('../services/recordService');

const getRecordForMaquina = (req, res) => {
    const {
        params: { maquinaId },
    } = req;	

    if (!maquinaId) {
        res
            .status(400)
            .send({
                status: "FAILED", 
                data: { error: "Missing maquinaId" } 
            });
        return;
    }

    try {
        const record = recordService.getRecordForMaquina(maquinaId);
        res.send({ status: "OK", data: record });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

const getRecordForCategoria = (req, res) => {
    const {
        params: { categoriaId },
    } = req;

    if (!categoriaId) {
        res
            .status(400)
            .send({
                status: "FAILED", 
                data: { error: "Missing categoriaId" } 
            });
        return;
    }

    try {
        const record = recordService.getRecordForCategoria(categoriaId);
        res.send({ status: "OK", data: record });
    }
    catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

const getRecordForEstoc = (req, res) => {
    const {
        params: { estocId },
    } = req;

    if (!estocId) {
        res
            .status(400)
            .send({
                status: "FAILED", 
                data: { error: "Missing estocId" } 
            });
        return;
    }

    try {
        const record = recordService.getRecordForEstoc(estocId);
        res.send({ status: "OK", data: record });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

const getRecordForProducte = (req, res) => {
    const {
        params: { producteId },
    } = req;

    if (!producteId) {
        res
            .status(400)
            .send({
                status: "FAILED",
                data: { error: "Missing producteId" }
            });
        return;
    }

    try {
        const record = recordService.getRecordForProducte(producteId);
        res.send({ status: "OK", data: record });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

module.exports = {
    getRecordForMaquina,
    getRecordForCategoria,
    getRecordForEstoc,
    getRecordForProducte,
};