<template>
  <section class="bg-[#F5F5F5] px-2 py-5 text-xs text-[#4C4C4C] font-medium">
    <div
      class="flex items-center px-1 py-2 mb-3 gap-2 rounded-xl border-2"
      :class="systemStatusStyle.card"
    >
      <div>
        <img
          class="w-17"
          :src="
            systemStatusStyle.icon === 'safe'
              ? safeStatusSystemIcon
              : warningStatusSystemIcon
          "
          alt="System Status Icon"
        />
      </div>

      <div>
        <h2>Status Sistem</h2>

        <h2 class="font-bold text-base" :class="systemStatusStyle.text">
          {{ systemStatus }}
        </h2>

        <h2>
          {{
            systemStatusStyle.icon === "safe"
              ? "Tidak Ada Indikasi Bahaya"
              : "Indikasi Bahaya Terdeteksi"
          }}
        </h2>
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
            {{ sensorData.gasPpm }} <span class="font-normal text-xs">PPM</span>
          </p>

          <div class="h-1.5 w-full overflow-hidden rounded-full bg-gray-300">
            <div
              class="h-full rounded-full transition-all duration-300"
              :class="gasProgressColor"
              :style="{ width: `${gasProgress}%` }"
            ></div>
          </div>
        </div>
      </div>

      <!-- Card Status Asap -->
      <div
        class="flex min-w-0 flex-col justify-center gap-3 rounded-xl border-2 p-3 border-[#DDDDDD] bg-[#EEEEEE]"
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
          <img
            class="h-5 w-5 shrink-0"
            :src="
              smokeStatus.icon === 'warning'
                ? warningSmokeStatusSystemIcon
                : safeSmokeStatusSystemIcon
            "
            alt=""
          />

          <p class="font-bold text-xs" :class="smokeStatus.text_color">
            {{ smokeStatus.text }}
          </p>
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
          {{ sensorData.temperature }}
          <span class="font-normal text-xs">°C</span>
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
          {{ sensorData.humidity }} <span class="font-normal text-xs">%</span>
        </p>
      </div>
    </div>
  </section>
</template>
<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";

import safeStatusSystemIcon from "../assets/icons/safe-status-system-icon.svg";
import warningStatusSystemIcon from "../assets/icons/warning-status-system-icon.svg";
import lpgAmountIcon from "../assets/icons/lpg-amount-icon.svg";
import smokeIcon from "../assets/icons/smoke-icon.svg";
import warningSmokeStatusSystemIcon from "../assets/icons/warning-smoke-status-system-icon.svg";
import safeSmokeStatusSystemIcon from "../assets/icons/safe-smoke-status-system-icon.svg";
import tempIcon from "../assets/icons/temp-icon.svg";
import humidityIcon from "../assets/icons/humidity-icon.svg";

// Alamat endpoint Laravel API
const API_URL = "http://127.0.0.1:8000/api/sensor-readings/latest";

// State untuk menyimpan pembacaan sensor
const sensorData = ref({
  gasPpm: null,
  smokeDetected: false,
  temperature: null,
  humidity: null,
});

// State untuk kondisi pengambilan data
const hasData = ref(false);
const isLoading = ref(true);
const apiError = ref("");

// Mengambil data terbaru dari Laravel
const fetchSensorData = async () => {
  try {
    const response = await fetch(API_URL);

    if (!response.ok) {
      throw new Error(`HTTP error: ${response.status}`);
    }

    const result = await response.json();

    // API berhasil diakses, tetapi belum ada pembacaan sensor
    if (result.data === null) {
      hasData.value = false;
      apiError.value = "";
      return;
    }

    // Memetakan nama field Laravel ke nama variabel Vue
    sensorData.value = {
      gasPpm: result.data.gas_ppm,
      smokeDetected: result.data.smoke_detected,
      temperature: result.data.temperature,
      humidity: result.data.humidity,
    };

    hasData.value = true;
    apiError.value = "";
  } catch (error) {
    apiError.value = error.message;
    console.error("Gagal mengambil data sensor:", error);
  } finally {
    isLoading.value = false;
  }
};

// Batas maksimum skala visual progress bar
const gasScaleMax = 1000;

// Menghitung lebar progress bar
const gasProgress = computed(() => {
  if (!hasData.value || sensorData.value.gasPpm == null) {
    return 0;
  }

  return Math.min(
    Math.max((sensorData.value.gasPpm / gasScaleMax) * 100, 0),
    100,
  );
});

// Menentukan warna progress bar
const gasProgressColor = computed(() => {
  if (!hasData.value || sensorData.value.gasPpm == null) {
    return "bg-gray-400";
  }

  if (sensorData.value.gasPpm < 400) {
    return "bg-[#00C68D]";
  }

  if (sensorData.value.gasPpm < 700) {
    return "bg-orange-400";
  }

  return "bg-red-500";
});

// Menentukan teks status sistem
const systemStatus = computed(() => {
  if (!hasData.value) {
    return isLoading.value ? "Memuat Data Sensor..." : "Menunggu Data Sensor";
  }

  if (sensorData.value.gasPpm == null) {
    return "Data Gas Tidak Tersedia";
  }

  if (sensorData.value.gasPpm > 400 && !sensorData.value.smokeDetected) {
    return "Terdapat Kebocoran Gas!";
  } else if (sensorData.value.gasPpm < 400 && sensorData.value.smokeDetected) {
    return "Asap Terdeteksi!";
  } else if (sensorData.value.gasPpm > 400 && sensorData.value.smokeDetected) {
    return "TERDAPAT KEBOCORAN GAS LPG DAN ASAP!";
  }

  return "Aman";
});

// Menentukan styling status sistem
const systemStatusStyle = computed(() => {
  if (!hasData.value || sensorData.value.gasPpm == null) {
    return {
      card: "border-gray-300 bg-gray-100",
      text: "text-gray-600",
      icon: "safe",
    };
  }

  const isDanger =
    sensorData.value.gasPpm > 400 || sensorData.value.smokeDetected;

  return isDanger
    ? {
        card: "border-[#E11A45] bg-[#FFB6C1]",
        text: "text-[#E11A45]",
        icon: "warning",
      }
    : {
        card: "border-[#00C68D] bg-[#E8F5BD]",
        text: "text-[#00C68D]",
        icon: "safe",
      };
});

// Menentukan teks status asap
const smokeStatus = computed(() => {
  if (!hasData.value) {
    return {
      text_color: "text-gray-500",
      icon: "",
      text: "Menunggu Data Sensor",
    };
  }

  return sensorData.value.smokeDetected
    ? {
        text_color: "text-red-500",
        icon: "warning",
        text: "Asap Terdeteksi!",
      }
    : {
        text_color: "text-[#00C68D]",
        icon: "",
        text: "Tidak Ada Asap",
      };
});

// Ambil data saat dashboard dibuka,
// lalu perbarui setiap 5 detik.
let pollingInterval;

onMounted(() => {
  fetchSensorData();
  pollingInterval = setInterval(fetchSensorData, 5000);
});

// Hentikan polling ketika komponen dilepas
onUnmounted(() => {
  clearInterval(pollingInterval);
});
</script>
