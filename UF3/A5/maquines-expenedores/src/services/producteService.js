// Renombrem el mètode perquè no es confongui amb el mètode de la classe
const {v4: uuid} = require('uuid');

const Producte = require('../database/Producte.js');

const getAllProductes = (filterParams) => {
    try {
        const allProductes = Producte.getAllProductes(filterParams);
        return allProductes;
    } catch (error) {
        throw error;
    }
}

const getOneProducte = (producteId) => {
    try {
        const producte = Producte.getOneProducte(producteId);
        return producte;
    }
    catch (error) {
        throw error;
    }
};

const createOneProducte = (newProducte) => {
    const producteToInsert = {
        // Creem un nou objecte amb les dades que ens passen
        ...newProducte,

        // Afegim el id de forma aleatòria
        id: uuid(),
        
        createdAt: new Date().toLocaleString("en-US", { timeZone: "UTC" }),
        updatedAt: new Date().toLocaleString("en-US", { timeZone: "UTC" }),
    };

    try {
        const producte = Producte.createOneProducte(producteToInsert);
        return producte;
    } catch (error) {
        throw error;
    }
};

const updateOneProducte = (producteId, changes) => {
    try {
        const updatedProducte = Producte.updateOneProducte(producteId, changes);
        return updatedProducte;
    } catch (error) {
        throw error;
    }
};

const deleteOneProducte = (producteId) => {
    try {
        const producte = Producte.deleteOneProducte(producteId);
        return producte;
    } catch (error) {
        throw error;
    }
}

module.exports = {
    getAllProductes,
    getOneProducte,
    createOneProducte,
    updateOneProducte,
    deleteOneProducte
};
