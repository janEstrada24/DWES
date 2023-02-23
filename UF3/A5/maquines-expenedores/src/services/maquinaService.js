const { v4: uuid } = require("uuid");
const Maquines = require("../database/Maquines.js");

const getAllMaquines = (filterParams) => {
    try {
        const allMaquines = Maquines.getAllMaquines(filterParams);
        return allMaquines;
    }   catch (error) {
        throw error;
    }
}

const getOneMaquina = (maquinaId) => {
    try {
        const maquina = Maquines.getOneMaquina(maquinaId);
        return maquina;
    } catch (error) {      
        throw error;
    }
}

const createOneMaquina = (newMaquina) => {
    const maquinaToInsert = {
        ...newMaquina,
        id: uuid(),
        createdAt: new Date().toLocaleString("en-US", { timeZone: "UTC" }),
        updatedAt: new Date().toLocaleString("en-US", { timeZone: "UTC" }),
    };
    try {
        const maquina = Maquines.createOneMaquina(maquinaToInsert);
        return maquina;
    } catch (error) {
        throw error;
    }
}

const deleteMaquina = (maquinaId) => {
    try {
        const maquina = Maquines.deleteOneMaquina(maquinaId);
        return maquina;
    } catch (error) {
        throw error;
    }
}

module.exports = { 
    getAllMaquines, 
    getOneMaquina, 
    createOneMaquina, 
    deleteMaquina 
};