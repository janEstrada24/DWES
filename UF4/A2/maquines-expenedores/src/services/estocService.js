// Renombrem el mètode perquè no es confongui amb el mètode de la classe
const {v4: uuid} = require('uuid');

const Estoc = require('../database/Estoc.js');

const getAllEstocs = (filterParams) => {
    try {
        const allEstocs = Estoc.getAllEstocs(filterParams);
        return allEstocs;
    } catch (error) {
        throw error;
    }
};

const getOneEstoc = (estocId) => {
    try {
        const estoc = Estoc.getOneEstoc(estocId);
        return estoc;
    }
    catch (error) {
        throw error;
    }
};

const createOneEstoc = (newEstoc) => {
    const estocToInsert = {
        // Creem un nou objecte amb les dades que ens passen
        ...newEstoc,

        // Afegim el id de forma aleatòria
        id: uuid(),
        
        createdAt: new Date().toLocaleString("en-US", { timeZone: "UTC" }),
        updatedAt: new Date().toLocaleString("en-US", { timeZone: "UTC" }),
    };

    try {
        const estoc = Estoc.createOneEstoc(estocToInsert);
        return estoc;
    } catch (error) {
        throw error;
    }
};

const updateOneEstoc = (estocId, changes) => {
    try {
        const updatedEstoc = Estoc.updateOneEstoc(estocId, changes);
        return updatedEstoc;
    } catch (error) {
        throw error;
    }
};

const deleteOneEstoc = (estocId) => {
    try {
        const estoc = Estoc.deleteOneEstoc(estocId);
        return estoc;
    } catch (error) {
        throw error;
    }
};

module.exports = {
    getAllEstocs,
    getOneEstoc,
    createOneEstoc,
    updateOneEstoc,
    deleteOneEstoc,
};
