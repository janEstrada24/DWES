const maquinesService = require('../services/maquinaService');

const getAllMaquines = (req, res, next) => {
    const { mode } = req.query;
    try {
        const allMaquines = maquinesService.getAllMaquines({ mode });
        res.send({ status: "OK", data: allMaquines });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

const getOneMaquina = (req, res, next) => {
    const {
        params: { maquinaId },
    } = req;

    if (!maquinaId) {
        res.status(400).send({ status: "FAILED", data: { error: "Missing maquinaId" } });
    }

    try {
        const maquina = maquinesService.getOneMaquina(maquinaId);
        res.send({ status: "OK", data: maquina });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

const createOneMaquina = (req, res, next) => {
    const { body } = req;

    if (!body.municipi ||
        !body.adreca) {
        res.status(400).send({
            status: "FAILED",
            data: { 
                error: "One of the following keys is missing or is empty in request body: municipi, adreca"
            }}
        );
        return;
    }

    const newMaquina = {
        municipi: body.municipi,
        adreca: body.adreca,
    };

    try {
        const createdMaquina = maquinesService.createOneMaquina(newMaquina);
        res.send({ status: "OK", data: createdMaquina });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
}

const deleteOneMaquina = (req, res, next) => {
    const {
        params: { maquinaId },
    } = req;

    if (!maquinaId) {
        res.status(400).send({ 
            status: "FAILED", 
            data: { error: "Param maquinaId cannot be empty" }
        });
    }

    try {
        maquinesService.deleteMaquina(maquinaId);
        res.status(204).send({ status: "OK" });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message || error } });
    }
};

module.exports = {
    getAllMaquines,
    getOneMaquina,
    createOneMaquina,
    deleteOneMaquina,
};