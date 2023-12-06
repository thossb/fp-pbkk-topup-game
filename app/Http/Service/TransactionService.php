<?php

// App/Http/Service/TransactionService.php

namespace App\Http\Service;

use App\Http\Repository\TransactionRepository;
use Illuminate\Http\Request;

class TransactionService
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getMyTransactions(Request $request)
    {
        return $this->transactionRepository->getMyTransactions($request);
    }

    public function getAllTransactions()
    {
        return $this->transactionRepository->getAllTransactions();
    }

    public function getTransactionsData()
    {
        return $this->transactionRepository->getTransactionsData();
    }

    public function createTransaction(Request $request)
    {
        return $this->transactionRepository->createTransaction($request);
    }

    public function updateTransaction(Request $request, $id)
    {
        return $this->transactionRepository->updateTransaction($request, $id);
    }

    public function rejectTransaction(Request $request, $id)
    {
        return $this->transactionRepository->rejectTransaction($request, $id);
    }
}
