const DB = require('./db.json');
const { saveToDatabase } = require('./utils');

const getAllEstocs = (filterParams) => {
    try {
        let estocs = DB.estocs;
        if (filterParams.mode) {
            return DB.estocs.filter((estoc) =>
                estoc.mode.toLowerCase().includes(filterParams.mode)
            );
        }
        return estocs;
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const getOneEstoc = (estocId) => {
    try {
        const estoc = DB.estocs.find((estoc) => estoc.id === estocId);
        if (!estoc) {
            throw {
                status: 400,
                message: `Can't find estoc with the id '${estocId}'`,
            };
        }

        return estoc;
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const createOneEstoc = (newEstoc) => {
    try {
        // Comprovem que l'estoc no existeixi abans de crear-lo
        const isAlreadyAdded =
            DB.estocs.findIndex((estoc) => estoc.id === newEstoc.id) > -1;
        
        if(isAlreadyAdded)  {
            throw {
                status: 400,
                message: `Estoc with id '${newEstoc.id}' already exists`,
            };
        }

        // Comprovem si el producte dins de l'estoc existeix abans de crear l'estoc
        const productExists =
            DB.productes.findIndex((producte) => producte.id === newEstoc.producte) > -1;

        if(!productExists) {
            throw {
                status: 400,
                message: `Product of estoc with id '${newEstoc.producte} doesn't exists`,
            };
        }
        DB.estocs.push(newEstoc);
        saveToDatabase(DB);
        
        return newEstoc;
    
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const updateOneEstoc = (estocId, changes) => {
    try {

        // Comprovem que l'estoc existeixi abans de fer l'update
        const estocIndexForUpdate = 
            DB.estocs.findIndex(
                (estoc) => estoc.id === estocId
            );
        
        if (estocIndexForUpdate === -1) {
            throw {
                status: 400,
                message: `Can't find estoc with the id '${estocId}'`,
            };
        }
        
        // Comprovem que s'hagi afegit l'apartat de producte dins de l'estoc abans de comprovar si existeix
        if(changes.producte != undefined) {
            const producteIsAlreadyAdded = 
                DB.productes.findIndex(
                    (producte) => producte.id === changes.producte
                );
            
            // Comprovem que el producte ficat a l'estoc a actualitzar existeixi
            if (!producteIsAlreadyAdded) {
                throw {
                    status: 400,
                    message: `Can't find producte with the id '${changes.producte}'`,
                };
            }
        }

        const updatedEstoc = {
            ...DB.estocs[estocIndexForUpdate],
            ...changes,
            updatedAt: new Date().toLocaleString("en-US", { timeZone: "UTC" }),
        }

        DB.estocs[estocIndexForUpdate] = updatedEstoc;
        saveToDatabase(DB);
        
        return updatedEstoc;
        
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const deleteOneEstoc = (estocId) => {
    try {
        const indexForDeletion = DB.estocs.findIndex(
            (estoc) => estoc.id === estocId
        );

        if(indexForDeletion === -1) {
            throw {
                status: 400,
                message: `Can't find estoc with the id '${estocId}'`,
            };
        }

        DB.estocs.splice(indexForDeletion, 1);
        saveToDatabase(DB);
    
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

module.exports = {
    getAllEstocs,
    getOneEstoc,
    createOneEstoc,
    updateOneEstoc,
    deleteOneEstoc,
};