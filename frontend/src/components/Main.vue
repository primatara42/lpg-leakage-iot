<template>
  <section class="bg-[#F5F5F5] px-2 py-5 text-xs text-[#4C4C4C] font-medium">
    <div
      class="flex items-center px-1 py-2 mb-3 gap-2 rounded-xl border-2 border-[#00C68D] bg-[#E8F5BD]"
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

        <h2 class="font-bold text-[#00C68D] text-base">Aman</h2>

        <h2>Tidak Ada Indikasi Bahaya</h2>
      </div>
    </div>
    <!-- Container untuk ketiga card -->
    <div class="grid grid-cols-2 gap-3">
      <!-- Card Kadar Gas LPG -->
      <div
        class="flex min-w-0 flex-col justify-between gap-3 rounded-xl border-2 border-[#FF5A00] bg-[#F5CDBD] p-3"
      >
        <!-- Header -->
        <div class="flex min-w-0 items-center gap-2">
          <img
            class="h-6 w-6 shrink-0"
            :src="lpgAmountIcon"
            alt="Ikon kadar gas LPG"
          />

          <h2>Kadar Gas LPG</h2>
        </div>

        <!-- Nilai dan progress bar -->
        <div class="flex flex-col gap-2">
          <p class="font-bold text-base">
            280 <span class="font-normal text-xs">PPM</span>
          </p>

          <div class="h-1.5 w-full overflow-hidden rounded-full bg-gray-300">
            <div class="h-full w-[38%] rounded-full bg-emerald-400"></div>
          </div>
        </div>
      </div>

      <!-- Card Status Asap -->
      <div
        class="flex min-w-0 flex-col justify-center gap-3 rounded-xl border-2 border-[#DDDDDD] bg-[#EEEEEE] p-3"
      >
        <!-- Header -->
        <div class="flex min-w-0 items-center gap-2">
          <img
            class="h-6 w-6 shrink-0"
            :src="smokeIcon"
            alt="Ikon status asap"
          />

          <h2>Status Asap</h2>
        </div>

        <!-- Status -->
        <div class="flex items-center gap-1">
          <img class="h-5 w-5 shrink-0" :src="smokeStatusIcon" alt="" />

          <p class="font-bold text-xs text-[#00C68D]">Tidak Ada Asap</p>
        </div>
      </div>

      <!-- Card Suhu -->
      <div
        class="flex min-w-0 flex-col gap-3 rounded-xl border-2 border-[#E11A45] bg-[#FFB6C1] p-3"
      >
        <!-- Header -->
        <div class="flex min-w-0 items-center gap-2">
          <img class="h-6 w-6 shrink-0" :src="tempIcon" alt="Ikon suhu" />

          <h2>Suhu</h2>
        </div>

        <!-- Nilai suhu -->
        <p class="font-bold text-base">
          32 <span class="font-normal text-xs">°C</span>
        </p>
      </div>

      <!-- Card Kelembapan -->
      <div
        class="flex min-w-0 flex-col gap-3 rounded-xl border-2 border-[#99C2FF] bg-[#CFEBFF] p-3"
      >
        <!-- Header -->
        <div class="flex min-w-0 items-center gap-2">
          <img class="h-6 w-6 shrink-0" :src="humidityIcon" alt="Ikon suhu" />

          <h2>Kelembapan</h2>
        </div>

        <!-- Nilai suhu -->
        <p class="font-bold text-base">
          29 <span class="font-normal text-xs">%</span>
        </p>
      </div>
    </div>
  </section>
</template>
<script setup>
import safeStatusSystemIcon from "../assets/icons/safe-status-system-icon.svg";
import lpgAmountIcon from "../assets/icons/lpg-amount-icon.svg";
import smokeIcon from "../assets/icons/smoke-icon.svg";
import smokeStatusIcon from "../assets/icons/smoke-status-system-icon.svg";
import tempIcon from "../assets/icons/temp-icon.svg";
import humidityIcon from "../assets/icons/humidity-icon.svg";
</script>
