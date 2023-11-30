<template>
    <div class="flex container mx-auto">
        <div class="flex-1  p-4 border border-gray-300 m-2" v-for="(formations, index) in columns" :key="index"
            @dragover="dragOverEmpty($event, index)" @drop="dropEmpty(1)">
            <h2 class="text-xl">{{ columnsLabels[index] }}</h2>
            <div class="min-h-96  bg-gray-100 border border-gray-300 p-2 mt-2">

                <div v-if="formations.length === 0" class="text-gray-500 text-center text-sm mt-4">
                    AUCUNE FORMATION AFFECTÉE
                </div>

                <div class="bg-white flex justify-between items-center p-2 border border-gray-300 m-1 cursor-pointer"
                    v-for="(formation, formationIndex) in formations" :key="formationIndex" @dragstart="dragStart(formation, index, formationIndex)"
                    @dragover="dragOver($event, index, formationIndex)" @dragend="dragEnd" @drop="drop(formation, index, formationIndex)"
                    :draggable="index === 0">
                    {{ formation.titre }}
                    <div v-if="index === 0" class="bg-blue-500 text-white p-1 mt-1 text-center">
                        Glisser pour affecter
                    </div>
                    <button v-if="index === 1" @click="deassign(formation, formationIndex)" class="text-red-500 hover:text-red-700">
                        Désaffecter
                    </button>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';


let props = defineProps({
    formations: {
        type: Array,
        default: () => ({}),
    }
})

console.log(props.formations);

const columnsLabels = ref(['Formations', 'Utilisateurs']);
const columns = ref([
props.formations,
    [],
]);

let draggedFormation = null;
let sourceColumnIndex = null;
let sourceFormationIndex = null;

// Cette fonction est appelée lorsqu'un élément commence à être glissé (drag and drop).
// Elle capture l'élément de formation qui commence à être glissé, ainsi que l'index de la colonne et de la formation d'origine.
const dragStart = (formation, columnIndex, formationIndex) => {
    if (columnIndex === 0) {
        draggedFormation = formation;
        sourceColumnIndex = columnIndex;
        sourceFormationIndex = formationIndex;
    }
};


// Appelée lorsque l'élément glissé est survolé par un autre élément.
// Empêche le comportement par défaut du navigateur (qui empêcherait le glissement) si l'élément survolé est dans la colonne des utilisateurs (colonne d'index 1) et que la formation n'a pas déjà été affectée à un utilisateur.
const dragOver = (event, columnIndex, formationIndex) => {
    if (columnIndex === 1 && !columns.value[1].includes(draggedFormation)) {
        event.preventDefault();
    }
};

//  Appelée lorsque le glissement de l'élément est terminé.
// Réinitialise les variables utilisées pour suivre l'élément glissé et sa position d'origine.
const dragEnd = () => {
    draggedFormation = null;
    sourceColumnIndex = null;
    sourceFormationIndex = null;
};


// Appelée lorsque l'élément glissé est déposé dans une zone cible.
// Fonctionnalité : Ajoute l'élément glissé à la colonne des utilisateurs (colonne d'index 1) si les conditions le permettent. Les conditions incluent le fait que l'élément n'ait pas déjà été affecté à un utilisateur et que la colonne cible soit la colonne des utilisateurs.
const drop = (formation, columnIndex, formationIndex) => {
    if (draggedFormation !== null && columnIndex === 1 && !columns.value[1].includes(draggedFormation)) {

        columns.value[columnIndex].splice(formationIndex, 0, draggedFormation);
        draggedFormation = null;
        sourceColumnIndex = null;
        sourceFormationIndex = null;

        // Maintenant, vous pouvez utiliser draggedFormationId comme l'ID de la formation glissée.
        // console.log("idformation  : " + formation.id);
        // console.log("Index de la colonne : " + columnIndex);
        console.log("formationindex : " + formationIndex);
    }
};


//  Appelée lorsque vous souhaitez désaffecter une formation d'un utilisateur.
// Supprime l'élément de la colonne des utilisateurs.
const deassign = (formation, formationIndex) => {
    if (columns.value[1].includes(formation)) {
        columns.value[1].splice(formationIndex, 1); // Supprimer l'utilisateur
    }
};


//  Appelée lorsque l'élément glissé est survolé par une zone vide.
// Fonctionnalité : Empêche le comportement par défaut du navigateur (qui empêcherait le glissement) et permet aux utilisateurs de déposer des formations dans une zone vide.
const dragOverEmpty = (event, columnIndex) => {
    event.preventDefault();
};


// Appelée lorsque l'élément glissé est déposé dans une zone vide.
// Fonctionnalité : Ajoute l'élément glissé à la colonne des utilisateurs (colonne d'index 1) s'il n'a pas déjà été affecté à un utilisateur.
const dropEmpty = (columnIndex) => {
    if (draggedFormation !== null && columnIndex === 1) {
        // Vérifier si la formation n'est pas déjà affectée à un utilisateur
        if (!columns.value[1].includes(draggedFormation)) {
            columns.value[columnIndex].push(draggedFormation);
            draggedFormation = null;
            sourceColumnIndex = null;
            sourceFormationIndex = null;
        } else {
            // La formation est déjà affectée à un utilisateur, vous pouvez afficher un message d'erreur ou prendre une autre action.
            console.log("Cette formation est déjà affectée à un utilisateur.");
        }
    }
};
</script>
<style scoped>
.empty-dropzone {
    width: 100%;
    height: 20px;
    /* Ajustez la hauteur selon vos besoins */
    background-color: transparent;
    margin: 2px;
    border: 2px dashed #ccc;
    box-sizing: border-box;
}
</style>
