<template>
  <section class="px-2 py-5 text-xs">
    <!-- Container untuk ketiga card -->
    <div class="grid grid-cols-2 gap-3">
      <!-- Card Kadar Gas LPG -->
      <div
        class="flex min-w-0 flex-col justify-between gap-3 rounded-xl border-2 border-[#FF5A00] bg-[#F5CDBD] p-3"
      >
        <!-- Header -->
        <div class="flex min-w-0 flex-col gap-2">
          <img
            class="h-6 w-6 shrink-0"
            :src="lpgAmountIcon"
            alt="Ikon kadar gas LPG"
          />

          <h2 class="text-sm font-medium leading-tight">Kadar Gas LPG</h2>
        </div>

        <!-- Nilai dan progress bar -->
        <div class="flex flex-col gap-2">
          <p class="text-lg font-bold">
            280 <span class="text-sm font-normal">PPM</span>
          </p>

          <div class="h-1.5 w-full overflow-hidden rounded-full bg-gray-300">
            <div class="h-full w-[38%] rounded-full bg-emerald-400"></div>
          </div>
        </div>
      </div>

      <!-- Card Status Asap -->
      <div
        class="flex min-w-0 flex-col justify-between gap-3 rounded-xl border-2 border-[#DDDDDD] bg-[#EEEEEE] p-3"
      >
        <!-- Header -->
        <div class="flex min-w-0 flex-col gap-2">
          <img
            class="h-6 w-6 shrink-0"
            :src="smokeIcon"
            alt="Ikon status asap"
          />

          <h2 class="text-sm font-medium leading-tight">Status Asap</h2>
        </div>

        <!-- Status -->
        <div class="flex flex-col gap-1">
          <img class="h-5 w-5 shrink-0" :src="smokeStatusIcon" alt="" />

          <p class="text-sm font-bold leading-tight text-[#00C68D]">
            Tidak Ada Asap
          </p>
        </div>
      </div>

      <!-- Card Suhu -->
      <div
        class="flex min-w-0 flex-col justify-between gap-3 rounded-xl border-2 border-[#E11A45] bg-[#FFB6C1] p-3"
      >
        <!-- Header -->
        <div class="flex min-w-0 flex-col gap-2">
          <img class="h-6 w-6 shrink-0" :src="tempIcon" alt="Ikon suhu" />

          <h2 class="text-sm font-medium leading-tight">Suhu</h2>
        </div>

        <!-- Nilai suhu -->
        <p class="text-lg font-bold">
          32 <span class="text-sm font-normal">°C</span>
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
</script>
