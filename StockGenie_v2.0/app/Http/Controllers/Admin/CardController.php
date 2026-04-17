<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardStoreRequest;
use App\Http\Requests\CardUpdateRequest;
use App\Services\Card\CardService;

class CardController extends Controller
{
    public function __construct(
        private readonly CardService $cardService
    ) {}

    public function index()
    {
        return view('admin.cards.index', [
            'cards' => $this->cardService->list()
        ]);
    }

    public function store(CardStoreRequest $request)
    {
        $this->cardService->create($request->validated());

        return back()->with('success', 'Card created');
    }

    public function update(CardUpdateRequest $request, int $id)
    {
        $this->cardService->update($id, $request->validated());

        return back()->with('success', 'Card updated');
    }

    public function block(int $id)
    {
        $this->cardService->block($id);

        return back()->with('success', 'Card blocked');
    }
}
