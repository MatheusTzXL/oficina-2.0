<template>
  <form @submit.prevent="salvar" class="space-y-8 p-6 bg-white rounded-lg shadow-md">
    <!-- Cliente -->
    <div>
      <label for="cliente" class="block text-sm font-medium text-gray-700 mb-2">Cliente</label>
      <input
        v-model="form.cliente"
        type="text"
        id="cliente"
        class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
        required
      />
    </div>

    <!-- Data e Hora -->
    <div>
      <label for="data_hora" class="block text-sm font-medium text-gray-700 mb-2">Data e Hora</label>
      <input
        v-model="form.data_hora"
        type="datetime-local"
        id="data_hora"
        class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
        required
      />
    </div>

    <!-- Vendedor -->
    <div>
      <label for="vendedor" class="block text-sm font-medium text-gray-700 mb-2">Vendedor</label>
      <input
        v-model="form.vendedor"
        type="text"
        id="vendedor"
        class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
        required
      />
    </div>

    <!-- Descrição -->
    <div>
      <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
      <textarea
        v-model="form.descricao"
        id="descricao"
        class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
        required
      ></textarea>
    </div>

    <!-- Valor -->
    <div>
      <label for="valor" class="block text-sm font-medium text-gray-700 mb-2">Valor</label>
      <input
        v-model="form.valor"
        type="number"
        id="valor"
        step="0.01"
        class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
        required
      />
    </div>

    <!-- Botões -->
    <div class="flex gap-4">
      <button
        type="submit"
        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg transition transform hover:scale-105"
      >
        {{ form.id ? 'Atualizar' : 'Salvar' }} Orçamento
      </button>

      <button
        v-if="form.id"
        type="button"
        @click="$emit('cancelar')"
        class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded-lg transition transform hover:scale-105"
      >
        Cancelar
      </button>
    </div>
  </form>
</template>

<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'
import { defineProps, defineEmits } from 'vue'

const props = defineProps({
  orcamentoParaEditar: Object
})
const emit = defineEmits(['salvo', 'cancelar', 'mensagem'])

const form = ref({
  cliente: '',
  data_hora: '',
  vendedor: '',
  descricao: '',
  valor: 0
})

// Preenche o form quando recebe a prop
watch(() => props.orcamentoParaEditar, (novo) => {
  if (novo) form.value = { ...novo }
})

const salvar = async () => {
  try {
    if (form.value.id) {
      await axios.put(`http://127.0.0.1:8000/api/orcamentos/${form.value.id}`, form.value)
      emit('mensagem', 'Orçamento atualizado com sucesso!', 'sucesso')
    } else {
      await axios.post('http://127.0.0.1:8000/api/orcamentos', form.value)
      emit('mensagem', 'Orçamento criado com sucesso!', 'sucesso')
    }

    emit('salvo')
  } catch (erro) {
    emit('mensagem', 'Erro ao salvar o orçamento. Tente novamente.', 'erro')
  }

  form.value = {
    cliente: '',
    data_hora: '',
    vendedor: '',
    descricao: '',
    valor: 0
  }
}
</script>