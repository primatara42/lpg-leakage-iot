<template>
  <section class="px-2 py-5">
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
    <div class="flex gap-1">
      <div class="w-1/2 rounded-xl p-1 border border-[#FF5A00]">
        <div class="flex">
          <div><img :src="lpgAmountIcon" alt="" /></div>
          <h2>Kadar Gas LPG</h2>
        </div>
        <div>
          <h2>280<span>PPM</span></h2>
          <div class="w-full"></div>
        </div>
      </div>
      <div class="w-1/2 rounded-xl p-1 border border-[#FF5A00]">
        <div class="flex">
          <div><img :src="lpgAmountIcon" alt="" /></div>
          <h2>Kadar Gas LPG</h2>
        </div>
        <div>
          <h2>280<span>PPM</span></h2>
          <div class="w-full"></div>
        </div>
      </div>
    </div>
  </section>
</template>
<script setup>
import safeStatusSystemIcon from "../assets/icons/safe-status-system-icon.svg";
import lpgAmountIcon from "../assets/icons/lpg-amount-icon.svg";
</script>
