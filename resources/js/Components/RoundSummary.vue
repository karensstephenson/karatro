<script setup lang="ts">
import { defineEmits } from "vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faSun } from "@fortawesome/free-solid-svg-icons";

const emit = defineEmits(["cashOut"]);
</script>

<template>
    <div
        class="flex flex-col mx-auto mb-4 rounded-md outline outline-offset-2 outline-4 outline-slate-800 bg-black px-2 w-3/4"
    >
        <button
            @click="$emit('cashOut')"
            class="mx-auto mt-4 px-1 py-1 text-white bg-orange-500 rounded-md hover:bg-orange-600 w-1/2 text-3xl font-extrabold"
        >
            <p>Cash Out:  $<span>3</span></p>
        </button>
        <div
            class="flex justify-between items-center m-2 border-b border-dashed pb-2"
        >
            <div class="flex items-center">
                <div class="h-10 w-10 border rounded-full bg-green-300"></div>
                <div class="ml-3">
                    
                    <p class="text-white">Score at least</p>
                    <p class="text-red-500 text-xl font-extrabold"><span><FontAwesomeIcon :icon="faSun" class="text-white self-center border-2 rounded-full" /></span> 300</p>
                </div>
            </div>
            <div>
                <p class="text-orange-400 font-extrabold">$$$</p>
            </div>
        </div>
        <div class="flex justify-between items-center m-2">
            <p class="text-white"><span class="text-blue-400 text-2xl font-extrabold">2 </span> Remaining Hands ($1 each)</p>
            <p class="text-orange-400 font-extrabold">$$</p>
        </div>
        <div class="flex justify-between m-2">
            <p class="text-white"><span><FontAwesomeIcon :icon="faSun" class="text-white self-center border-2 rounded-full" /></span> Other bonus</p>
            <p class="text-orange-400 font-extrabold">$$$</p>
        </div>
        <div class="flex justify-between m-2">
            <p class="text-white"><span><FontAwesomeIcon :icon="faSun" class="text-white self-center border-2 rounded-full" /></span> Other bonus</p>
            <p class="text-orange-400 font-extrabold">$$$</p>
        </div>
        <div class="flex justify-between m-2">
            <p class="text-white"><span><FontAwesomeIcon :icon="faSun" class="text-white self-center border-2 rounded-full" /></span> Other bonus</p>
            <p class="text-orange-400 font-extrabold">$$$</p>
        </div>
    </div>
</template>
