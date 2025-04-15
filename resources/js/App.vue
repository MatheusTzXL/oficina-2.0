<template>
  <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-white p-6">
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-2xl p-8 md:p-12">
      <h1 class="text-4xl font-semibold text-center text-gray-800 mb-10">
        Gerenciador de Orçamentos
      </h1>

      <div
        v-if="mensagem"
        :class="mensagem.tipo === 'sucesso' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
        class="p-4 mb-4 rounded-lg"
      >
        {{ mensagem.texto }}
      </div>

      <!-- Formulário de Filtros -->
      <section class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Filtros</h2>
        <form @submit.prevent="aplicarFiltros" class="space-y-6">
          <div class="flex flex-wrap gap-6">
            <input
              v-model="filtros.cliente"
              type="text"
              placeholder="Cliente"
              class="w-full md:w-1/3 p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
            />
            <input
              v-model="filtros.vendedor"
              type="text"
              placeholder="Vendedor"
              class="w-full md:w-1/3 p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
            />
          </div>
          <div class="flex flex-wrap gap-6">
            <input
              v-model="filtros.data_inicio"
              type="date"
              class="w-full md:w-1/3 p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
            />
          </div>
          <div class="flex justify-end">
            <button
              type="submit"
              class="bg-indigo-600 text-white py-2 px-6 rounded-lg hover:bg-indigo-700"
            >
              Aplicar Filtros
            </button>
          </div>
        </form>
      </section>

      <!-- Formulário de Cadastro/Edição -->
      <section class="mb-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">
          {{ editando ? 'Editar Orçamento' : 'Novo Orçamento' }}
        </h2>
        <OrcamentoForm
          :orcamentoParaEditar="orcamentoParaEditar"
          @salvo="aoSalvar"
          @cancelar="cancelarEdicao"
          @mensagem="exibirMensagem"
        />
      </section>

      <!-- Lista de Orçamentos -->
      <section>
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Lista de Orçamentos</h2>

        <div v-if="carregando" class="flex justify-center py-4">
          <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-indigo-500"></div>
        </div>

        <div class="overflow-hidden shadow-lg border border-gray-300 rounded-lg mb-6">
          <OrcamentoList
            :orcamentos="orcamentos"
            @editar="editarOrcamento"
            @atualizar="buscarOrcamentos"
          />
        </div>

        <div class="flex justify-center mt-8">
          <button
            @click="buscarOrcamentos(paginaAtual - 1)"
            :disabled="paginaAtual === 1"
            class="bg-indigo-500 text-white px-6 py-3 rounded-l hover:bg-indigo-600"
          >
            Anterior
          </button>
          <span class="px-4 py-3">Página {{ paginaAtual }} de {{ totalPaginas }}</span>
          <button
            @click="buscarOrcamentos(paginaAtual + 1)"
            :disabled="paginaAtual === totalPaginas"
            class="bg-indigo-500 text-white px-6 py-3 rounded-r hover:bg-indigo-600"
          >
            Próxima
          </button>
        </div>
      </section>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

import OrcamentoForm from './components/OrcamentoForm.vue'
import OrcamentoList from './components/OrcamentoList.vue'

const orcamentos = ref([])
const filtros = ref({
  cliente: '',
  vendedor: '',
  data_inicio: '',
  data_fim: ''
})

const orcamentoParaEditar = ref(null)
const editando = ref(false)

const paginaAtual = ref(1)
const totalPaginas = ref(1)
const carregando = ref(false)

const mensagem = ref(null)

const exibirMensagem = (texto, tipo) => {
  mensagem.value = { texto, tipo }
  setTimeout(() => {
    mensagem.value = null
  }, 3000)
}

const buscarOrcamentos = async (pagina = 1) => {
  carregando.value = true
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/orcamentos', {
      params: { ...filtros.value, page: pagina }
    })
    orcamentos.value = response.data.data
    paginaAtual.value = response.data.current_page
    totalPaginas.value = response.data.last_page
    exibirMensagem('Orçamentos carregados com sucesso.', 'sucesso')
  } catch (error) {
    exibirMensagem('Erro ao carregar orçamentos.', 'erro')
  } finally {
    carregando.value = false
  }
}

const aplicarFiltros = () => {
  paginaAtual.value = 1
  buscarOrcamentos()
}

const editarOrcamento = (orcamento) => {
  orcamentoParaEditar.value = { ...orcamento }
  editando.value = true
}

const aoSalvar = () => {
  buscarOrcamentos()
  orcamentoParaEditar.value = null
  editando.value = false
}

const cancelarEdicao = () => {
  orcamentoParaEditar.value = null
  editando.value = false
}

onMounted(() => buscarOrcamentos())
</script>


