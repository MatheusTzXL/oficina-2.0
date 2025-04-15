<template>
  <div>
    <button
      @click="ordenarPorData"
      class="mb-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition duration-300 ease-in-out transform hover:scale-105"
    >
      Ordenar por Data
    </button>

    <div v-if="carregando" class="text-center p-6 text-gray-500">
      <span class="loader"></span>
      Carregando...
    </div>

    <!-- Tabela de Orçamentos -->
    <div class="overflow-x-auto">
      <table v-if="!carregando" class="min-w-full border border-gray-300 rounded-lg bg-white shadow-sm">
        <thead class="bg-blue-100 text-gray-700">
          <tr>
            <th class="p-4 border-b border-gray-300">Cliente</th>
            <th class="p-4 border-b border-gray-300">Data/Hora</th>
            <th class="p-4 border-b border-gray-300">Vendedor</th>
            <th class="p-4 border-b border-gray-300">Descrição</th>
            <th class="p-4 border-b border-gray-300">Valor</th>
            <th class="p-4 border-b border-gray-300">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="orcamento in orcamentosLocal"
            :key="orcamento.id"
            class="hover:bg-blue-50 transition duration-200"
          >
            <td class="p-4 border-b border-gray-200">{{ orcamento.cliente }}</td>
            <td class="p-4 border-b border-gray-200">{{ formatarData(orcamento.data_hora) }}</td>
            <td class="p-4 border-b border-gray-200">{{ orcamento.vendedor }}</td>
            <td class="p-4 border-b border-gray-200">{{ orcamento.descricao }}</td>
            <td class="p-4 border-b border-gray-200">R$ {{ parseFloat(orcamento.valor).toFixed(2) }}</td>
            <td class="p-4 border-b border-gray-200 space-x-2">
              <button
                @click="$emit('editar', orcamento)"
                class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-md transition transform hover:scale-105"
              >
                Editar
              </button>
              <button
                @click="excluir(orcamento.id)"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition transform hover:scale-105"
              >
                Excluir
              </button>
            </td>
          </tr>
          <tr v-if="orcamentosLocal.length === 0">
            <td colspan="6" class="text-center p-6 text-gray-500">
              Nenhum orçamento encontrado.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios'
import { defineProps, defineEmits, ref, watch } from 'vue'

const props = defineProps({
  orcamentos: Array
})
const emit = defineEmits(['editar', 'atualizar'])

const carregando = ref(false)
const orcamentosLocal = ref([...props.orcamentos])

watch(() => props.orcamentos, (novaLista) => {
  orcamentosLocal.value = [...novaLista]
})

const excluir = async (id) => {
  if (confirm('Tem certeza que deseja excluir este orçamento?')) {
    try {
      carregando.value = true
      await axios.delete(`http://127.0.0.1:8000/api/orcamentos/${id}`)
      alert("Orçamento excluído com sucesso!")
      emit('atualizar')
    } catch (error) {
      alert("Erro ao excluir orçamento!")
    } finally {
      carregando.value = false
    }
  }
}

const ordenarPorData = () => {
  orcamentosLocal.value.sort((a, b) => new Date(b.data_hora) - new Date(a.data_hora))
}

const formatarData = (dataHora) => {
  const data = new Date(dataHora)
  return data.toLocaleDateString('pt-BR') + ' ' + data.toLocaleTimeString('pt-BR')
}
</script>

