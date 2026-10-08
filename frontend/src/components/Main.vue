<template>
  <section class="px-3 py-5">
    <div
      class="flex items-center p-1 gap-2 border rounded-xl border-[#00C68D] bg-[#E8F5BD] text-[#4C4C4C]"
    >
      <div>
        <img
          class="w-17"
          :src="safeStatusSystemIcon"
          alt="System Status Icon"
        />
      </div>
      <div>
        <h2 class="">Status Sistem</h2>
        <h2 class="font-bold text-[#00C68D]">Aman</h2>
        <h2>Tidak Ada Indikasi Bahaya</h2>
      </div>
    </div>
  </section>
</template>
<script setup>
import safeStatusSystemIcon from "../assets/icons/safe-status-system-icon.svg";
</script>
