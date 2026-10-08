<template>
  <div class="flex items-center justify-between py-3 px-5 bg-danger">
    <div class="flex items-center gap-x-1">
      <div>
        <img
          :src="logoImg"
          alt="Logo Kebocoran Gas"
          class="text-primary-color w-10"
        />
      </div>
      <h1 class="text-black font-semibold text-xs">
        Monitoring <br />
        Kebocoran Gas
      </h1>
    </div>
    <div class="flex items-center gap-1">
      <span class="w-2 h-2 bg-green-500 rounded-full"></span>
      <span class="text-xs font-semibold text-green-500"> Online </span>
    </div>
  </div>
</template>

<script setup>
import logoImg from "../assets/icons/logo.svg";
</script>
