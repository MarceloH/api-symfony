<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\Request;

class ExtratorDadosRequest
{
    private function buscadadosRequest(Request $request)
    {
        $queryString = $request->query->all();
        $dadosOrdenacao = array_key_exists('sort', $queryString)
            ? $queryString['sort']
            : [];
        unset($queryString['sort']);

        $paginaAtual = array_key_exists('page', $queryString)
            ? $queryString['page']
            :1;
        unset($queryString['page']);
        $itensPorPagina = array_key_exists('itensPorPagina', $queryString)
            ? $queryString['itensPorPagina']
            :5;
        unset($queryString['itensPorPagina']);
        
        return [$queryString, $dadosOrdenacao, $paginaAtual,$itensPorPagina];
    }

    public function buscaDadosOrdenacao(Request $request)
    {
        [$informacoesDeOrdenacao, ] = $this->buscadadosRequest($request);

        return $informacoesDeOrdenacao;
    }

    public function buscaDadosFiltro(Request $request)
    {
        [, $filtro] = $this->buscadadosRequest($request);

        return $filtro;
    }

    public function buscaDadosPaginacao(Request $request)
    {
        [, , $paginaAtual,$itensPorPagina] = $this->buscadadosRequest($request);

        return [$paginaAtual,$itensPorPagina];
    }
}
