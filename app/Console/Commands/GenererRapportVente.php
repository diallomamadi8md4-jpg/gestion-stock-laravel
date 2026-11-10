<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RapportVente;
use App\Models\Vente;
use App\Models\PointVente;
use Carbon\Carbon;

class GenererRapportVente extends Command
{
    // Nom de la commande artisan
    protected $signature = 'rapport:generer';

    protected $description = 'Générer automatiquement un rapport de ventes pour chaque point de vente';

    public function handle()
    {
        $pointsVente = PointVente::all();
        $dateDebut = Carbon::now()->startOfMonth();
        $dateFin = Carbon::now()->endOfMonth();

        foreach ($pointsVente as $pv) {
            $ventes = Vente::where('pve_id', $pv->pve_id)
                           ->whereBetween('created_at', [$dateDebut, $dateFin])
                           ->get();

            RapportVente::create([
                'pve_id' => $pv->pve_id,
                'date_debut' => $dateDebut,
                'date_fin' => $dateFin,
                'total' => $ventes->sum('prix_total'),
                'nb_ventes' => $ventes->count(),
                'quantite_totale' => $ventes->sum('quantite'),
                'statut' => 'provisoire',
            ]);
        }

        $this->info('Rapports de ventes générés automatiquement.');
    }
}
