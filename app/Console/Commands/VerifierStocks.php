<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stock;
use App\Models\Reapprovisionnement;

class VerifierStocks extends Command
{
    protected $signature = 'stocks:verifier';
    protected $description = 'Vérifie les stocks et crée des réapprovisionnements automatiques si nécessaire';

    public function handle()
    {
        $stocks = Stock::whereColumn('quantite', '<', 'seuil_minimum')->get();

        foreach ($stocks as $stock) {
            Reapprovisionnement::create([
                'pve_id' => $stock->pve_id,
                'pro_id' => $stock->pro_id,
                'quantite' => 20, // quantité par défaut
                'type' => 'automatique',
            ]);

            $stock->quantite += 20;
            $stock->save();

            $this->info("Réapprovisionnement automatique ajouté pour le produit {$stock->pro_id}");
        }
    }
}
