<template>
  <section class="rounded-xl bg-white p-4 shadow-sm">
    <h2 class="mb-4 text-lg font-semibold text-gray-800">
      Riwayat Kondisi Lingkungan
    </h2>

    <!-- Tombol pemilihan parameter -->
    <div class="mb-5 flex flex-wrap gap-2">
      <button
        v-for="metric in metrics"
        :key="metric.key"
        type="button"
        @click="selectedMetric = metric.key"
        class="rounded-lg px-4 py-2 text-sm font-medium transition"
        :class="
          selectedMetric === metric.key
            ? 'text-white'
            : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
        "
        :style="
          selectedMetric === metric.key ? { backgroundColor: metric.color } : {}
        "
      >
        {{ metric.label }}
      </button>
    </div>

    <!-- Status pemuatan, error, dan data kosong -->
    <p v-if="isLoading" class="py-8 text-center text-gray-500">
      Memuat riwayat sensor...
    </p>

    <p v-else-if="errorMessage" class="py-8 text-center text-red-500">
      {{ errorMessage }}
    </p>

    <p v-else-if="readings.length === 0" class="py-8 text-center text-gray-500">
      Belum ada riwayat pembacaan sensor.
    </p>

    <!-- Grafik -->
    <template v-else>
      <div class="mb-4">
        <p class="text-sm text-gray-500">
          {{ selectedMetricLabel }}
        </p>

        <p class="text-2xl font-bold text-gray-900">
          {{ latestValue }}
          <span class="text-sm font-normal text-gray-500">
            {{ selectedUnit }}
          </span>
        </p>
      </div>

      <div class="relative h-64 w-full">
        <Line :data="chartData" :options="chartOptions" :key="selectedMetric" />
      </div>

      <p class="mt-3 text-xs text-gray-500">
        Menampilkan hingga {{ readings.length }} pembacaan terakhir. Pembaruan
        otomatis setiap 10 detik.
      </p>
    </template>
  </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";

import { Line } from "vue-chartjs";

import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  LineElement,
  PointElement,
  CategoryScale,
  LinearScale,
} from "chart.js";

// Daftarkan elemen Chart.js yang diperlukan untuk grafik garis.
ChartJS.register(
  Title,
  Tooltip,
  Legend,
  LineElement,
  PointElement,
  CategoryScale,
  LinearScale,
);

const API_URL = "http://127.0.0.1:8000/api/sensor-readings";

// Daftar parameter beserta satuan dan warna grafik.
const metrics = [
  {
    key: "gas_ppm",
    label: "Kadar Gas",
    unit: "PPM",
    color: "#FF5A00",
  },
  {
    key: "temperature",
    label: "Suhu",
    unit: "°C",
    color: "#E11A45",
  },
  {
    key: "humidity",
    label: "Kelembapan",
    unit: "%",
    color: "#99C2FF",
  },
];

const readings = ref([]);
const isLoading = ref(true);
const errorMessage = ref("");
const selectedMetric = ref("gas_ppm");

// Informasi parameter yang sedang dipilih.
const selectedMetricInfo = computed(() => {
  return (
    metrics.find((metric) => metric.key === selectedMetric.value) ?? metrics[0]
  );
});

const selectedMetricLabel = computed(() => selectedMetricInfo.value.label);

const selectedUnit = computed(() => selectedMetricInfo.value.unit);

// Nilai paling baru berada di akhir array karena data sudah diurutkan.
const latestValue = computed(() => {
  if (readings.value.length === 0) return "—";

  const latestReading = readings.value[readings.value.length - 1];
  const value = latestReading[selectedMetric.value];

  if (value == null) return "—";

  return Number(value).toLocaleString("id-ID");
});

// Mengubah rekaman sensor menjadi data yang dapat dibaca Chart.js.
const chartData = computed(() => ({
  labels: readings.value.map((reading) => {
    const date = new Date(reading.created_at);

    return date.toLocaleTimeString("id-ID", {
      hour: "2-digit",
      minute: "2-digit",
      second: "2-digit",
    });
  }),

  datasets: [
    {
      label: `${selectedMetricLabel.value} (${selectedUnit.value})`,

      data: readings.value.map((reading) => {
        const value = reading[selectedMetric.value];

        return value == null ? null : Number(value);
      }),

      borderColor: selectedMetricInfo.value.color,
      backgroundColor: selectedMetricInfo.value.color,

      borderWidth: 2,
      pointRadius: 3,
      pointHoverRadius: 6,
      tension: 0.25,
      spanGaps: false,
    },
  ],
}));

// Pengaturan tampilan dan interaksi grafik.
const chartOptions = {
  responsive: true,
  maintainAspectRatio: false,

  interaction: {
    intersect: false,
    mode: "index",
  },

  plugins: {
    legend: {
      display: false,
    },

    tooltip: {
      enabled: true,
    },
  },

  scales: {
    x: {
      title: {
        display: true,
        text: "Waktu",
      },

      ticks: {
        maxTicksLimit: 7,
      },
    },

    y: {
      title: {
        display: true,
        text: "Nilai",
      },

      beginAtZero: false,
    },
  },
};

// Mengambil riwayat sensor dari Laravel.
const fetchReadings = async () => {
  try {
    const response = await fetch(API_URL);

    if (!response.ok) {
      throw new Error(`HTTP ${response.status}`);
    }

    const result = await response.json();

    if (!Array.isArray(result.data)) {
      throw new Error("Format data API tidak sesuai.");
    }

    // Laravel mengirim terbaru dahulu; grafik perlu lama ke baru.
    readings.value = [...result.data].reverse();

    errorMessage.value = "";
  } catch (error) {
    console.error("Gagal mengambil riwayat sensor:", error);

    errorMessage.value =
      "Gagal mengambil riwayat sensor. Periksa koneksi ke Laravel API.";
  } finally {
    isLoading.value = false;
  }
};

let pollingInterval;

onMounted(() => {
  fetchReadings();

  pollingInterval = setInterval(fetchReadings, 10000);
});

onUnmounted(() => {
  clearInterval(pollingInterval);
});
</script>
