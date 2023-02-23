const DB = require('./db.json');

const getRecordForMaquina = (maquinaId) => {
    try {
        const record = DB.records.filter(record => record.maquina === maquinaId);
        if (!record) {
            throw {
                status: 400,
                message: `Can't find maquina with the id '${workoutId}'`,
            };
        }
        return record;
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const getRecordForCategoria = (categoriaId) => {
    try {
        const record = DB.records.filter(record => record.categoria === categoriaId);
        if(!record) {
            throw {
                status: 400,
                message: `Can't find categoria with the id '${categoriaId}'`,
            };
        }
        return record;
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const getRecordForEstoc = (estocId) => {
    try {
        const record = DB.records.filter(record => record.estoc === estocId);
        if(!record) {
            throw {
                status: 400,
                message: `Can't find estoc with the id '${estocId}'`,
            };
        }
        return record;
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const getRecordForProducte = (producteId) => {
    try {
        const record = DB.records.filter(record => record.producte === producteId);
        if(!record) {
            throw {
                status: 400,
                message: `Can't find producte with the id '${producteId}'`,
            };
        }
        return record;
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

module.exports = { 
    getRecordForMaquina,
    getRecordForCategoria,
    getRecordForEstoc,
    getRecordForProducte
};