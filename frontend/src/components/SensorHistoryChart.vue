<template>
  <section class="rounded-xl bg-white p-4 shadow-sm">
    <h2 class="mb-4 text-lg font-semibold text-gray-800">
      Riwayat Kondisi Lingkungan
    </h2>

    <!-- Tombol untuk memilih parameter grafik -->
    <div class="mb-5 flex flex-wrap gap-2">
      <button
        v-for="metric in metrics"
        :key="metric.key"
        type="button"
        @click="selectedMetric = metric.key"
        class="rounded-lg px-4 py-2 text-sm font-medium transition"
        :class="
          selectedMetric === metric.key
            ? 'bg-orange-500 text-white'
            : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
        "
      >
        {{ metric.label }}
      </button>
    </div>

    <!-- Tampilan sementara sebelum grafik dibuat -->
    <div class="flex h-64 items-center justify-center rounded-lg bg-gray-50">
      <p class="text-sm text-gray-500">
        Grafik {{ selectedMetricLabel }} akan ditampilkan di sini.
      </p>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from "vue";

// Daftar parameter yang tersedia pada grafik.
const metrics = [
  { key: "gas_ppm", label: "Kadar Gas" },
  { key: "temperature", label: "Suhu" },
  { key: "humidity", label: "Kelembapan" },
];

// Menyimpan parameter yang sedang dipilih.
const selectedMetric = ref("gas_ppm");

// Mendapatkan nama parameter berdasarkan tombol yang dipilih.
const selectedMetricLabel = computed(() => {
  const selected = metrics.find(
    (metric) => metric.key === selectedMetric.value,
  );

  return selected ? selected.label : "Kadar Gas";
});
</script>
