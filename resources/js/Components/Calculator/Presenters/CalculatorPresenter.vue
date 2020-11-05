
<template>
    <div class="flex mb-4">
        <div class="w-3/4 bg-gray-400">
            <div class="flex p-2">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-principal">
                        Principal
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
                    id="grid-principal" 
                    type="number"
                    min="1"
                    @change="event => $emit('update-principal', event.target.value)" 
                    placeholder="Principal">
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-rate">
                        Annual Rate
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                    id="grid-rate" 
                    type="number"
                    min=".01" 
                    @change="event => $emit('update-rate', event.target.value)" 
                    placeholder="Rate">
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-length">
                        Length of Loan
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                    id="grid-length" 
                    type="number" 
                    min="1"
                    @change="event => $emit('update-length', event.target.value)" 
                    placeholder="Length of Loan">
                </div>
            </div>
            <div class="flex flex-wrap">
                <button class=" w-full shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded m-2" 
                type="button"
                @click=" () => $emit('submit-data')"
                >
                        Submit
                </button>
            </div>
            <div class="flex flex-wrap justify-center">
                <table class="table-auto" v-if="currentData != ''">
                    <thead>
                        <tr>
                        <th class="px-4 py-2">Principal</th>
                        <th class="px-4 py-2">Rate</th>
                        <th class="px-4 py-2">Length</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td class="border px-4 py-2"> {{ currentData.principal }} </td>
                        <td class="border px-4 py-2"> {{ currentData.rate }} </td>
                        <td class="border px-4 py-2"> {{ currentData.length }} </td>
                        </tr>
                        <tr>
                            <th class="border px-4 py-2 justify-center" colspan=3> Payment </th>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan=3> {{ currentData.payment }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-1/4 bg-gray-500 h-screen">
            <div class="flex flex-wrap justify-center p-2">
                <div class="flex flex-wrap w-full justify-center">
                    <p> Calculation History </p>
                </div>
                <div class="flex flex-wrap w-full justify-center">
                    <button class="w-1/2 shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded m-2" 
                    type="button"
                    @click=" () => $emit('clear-data')"
                    >
                            Clear
                    </button>
                </div>
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Principal</th>
                            <th class="px-4 py-2">Rate</th>
                            <th class="px-4 py-2">Length</th>
                            <th class="px-4 py-2">Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr 
                            v-for="data in calculationHistory"
                            :key="data.id"
                        >
                            <td class="border px-4 py-2"> {{ data.principal }} </td>
                            <td class="border px-4 py-2"> {{ data.rate }} </td>
                            <td class="border px-4 py-2"> {{ data.length }} </td>
                            <td class="border px-4 py-2"> {{ data.payment }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    props : ['calculationHistory', 'currentData'],
};
</script>