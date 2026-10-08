<template>
  <section class="px-2 py-5 text-xs">
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
    <div class="flex flex-wrap justify-between">
      <!-- Card Kadar LPG -->
      <div
        class="gap-3 px-1.5 flex flex-col justify-center h-32 max-w-35 rounded-xl border-2 border-[#FF5A00] bg-[#F5CDBD]"
      >
        <div class="flex items-center gap-2">
          <div><img class="w-7" :src="lpgAmountIcon" alt="" /></div>
          <h2>Kadar Gas LPG</h2>
        </div>
        <div>
          <h2 class="font-bold text-lg">
            280<span class="text-base">PPM</span>
          </h2>
          <div class="w-full h-1.5 bg-gray-300 rounded-full overflow-hidden">
            <div class="h-full w-[38%] bg-emerald-400 rounded-full"></div>
          </div>
        </div>
      </div>
      <!-- Card Status Udara -->
      <div
        class="gap-2 px-1.5 flex flex-col justify-center h-32 max-w-35 rounded-xl border-2 border-[#DDDDDD] bg-[#EEEEEE]"
      >
        <div class="flex items-center gap-2">
          <div><img :src="smokeIcon" alt="" /></div>
          <h2>Status Asap</h2>
        </div>
        <div class="flex items-center gap-2">
          <div><img class="w-5" :src="smokeStatusIcon" alt="" /></div>
          <h2 class="font-bold text-[#00C68D]">Tidak Ada Asap</h2>
        </div>
      </div>
    </div>
  </section>
</template>
<script setup>
import safeStatusSystemIcon from "../assets/icons/safe-status-system-icon.svg";
import lpgAmountIcon from "../assets/icons/lpg-amount-icon.svg";
import smokeIcon from "../assets/icons/smoke-icon.svg";
import smokeStatusIcon from "../assets/icons/smoke-status-system-icon.svg";
</script>
