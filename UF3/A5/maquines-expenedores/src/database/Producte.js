const DB = require('./db.json');
const { saveToDatabase } = require('./utils');

const getAllProductes = (filterParams) => {
    try {
        let productes = DB.productes;
        if (filterParams.mode) {
            return DB.productes.filter((producte) =>
                producte.mode.toLowerCase().includes(filterParams.mode)
            );
        }
        return productes;
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
}

const getOneProducte = (producteId) => {
    try {
        const producte = DB.productes.find((producte) => producte.id === producteId);
        
        if (!producte) {
            throw {
                status: 400,
                message: `Can't find producte with the id '${producteId}'`,
            };
        }

        return producte;
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
}


const createOneProducte = (newProducte) => {
    try {
        
        const isAlreadyAdded =
            DB.productes.findIndex((producte) => producte.nom === newProducte.nom) > -1;
        
        if(isAlreadyAdded) {
            throw {
                status: 400,
                message: `Producte with nom '${newProducte.nom}' already exists`,
            };
        }
        
        // Comprovem que la categoria en el producte existeixi
        const categoriaExists = 
            DB.categories.find((categoria) => categoria.id === newProducte.categoria);
        
        if(!categoriaExists) {
            throw {
                status: 400,
                message: `Categoria of producte with id '${newProducte.categoria}' doesn't exist`,
            };
        }

        DB.productes.push(newProducte);
        saveToDatabase(DB);
        
        return newProducte;

    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const updateOneProducte = (producteId, changes) => {
    try {
        const producteIsAlreadyAdded =
            DB.productes.findIndex(
                (producte) => producte.nom === changes.nom
            );
        
        if (producteIsAlreadyAdded === -1) {
            throw {
                status: 400,
                message: `Producte with nom '${changes.nom}' already exists`,
            };
        }

        const indexForUpdate = 
            DB.productes.findIndex(
                (producte) => producte.id === producteId
            );
    
        if (indexForUpdate === -1) {
            throw {
                status: 400,
                message: `Can't find producte with the id '${producteId}'`,
            };
        }
    
        // Comprovem si s'ha afegit també la categoria
        if(changes.categoria != undefined) {
            const categoriaIsAlreadyAdded = 
                DB.categories.findIndex(
                    (categoria) => categoria.id === changes.categoria
                );
            
            // Comprovem que la categoria en el producte existeixi
            if(!categoriaIsAlreadyAdded) {
                throw {
                    status: 400,
                    message: `Can't find categoria with the id '${changes.categoria}'`,
                };
            }
        }
        
        const updatedProducte = { 
            ...DB.productes[indexForUpdate],
            ...changes,
            updatedAt: new Date().toLocaleString("en-US", { timeZone: "UTC" }),
        };

        DB.productes[indexForUpdate] = updatedProducte;
        saveToDatabase(DB);

        return updatedProducte;
    
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const deleteOneProducte = (producteId) => {
    try {
        const indexForDeletion = DB.productes.findIndex(
            (producte) => producte.id === producteId
        );

        if (indexForDeletion === -1) {
            throw {
                status: 400,
                message: `Can't find producte with the id '${producteId}'`,
            };
        }

        DB.productes.splice(indexForDeletion, 1);
        saveToDatabase(DB);
    
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
}

module.exports = {
    getAllProductes,
    getOneProducte,
    createOneProducte,
    updateOneProducte,
    deleteOneProducte,
}