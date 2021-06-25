const temp = `
    <select :name="nameElement" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
        <option value="">Pilih</option>
        <option v-for="option in optionsSelect" :value="option.value">{{ option.value }}</option>
    </select>
`;

export default {
    props: {
        optionsSelect: {
            type: Array,
            default: () => {
                return [];
            }
        },
        nameElement: String
    },
    name: 'List',
    template: temp
}