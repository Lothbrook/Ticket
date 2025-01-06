<div x-data="{ isShowingLogs: false, isShowingComments: true, showModal: false }" class="min-h-screen bg-gray-100 p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <x-status />
    <div class="mb-6 text-2xl font-extrabold text-gray-900 sm:text-3xl lg:text-4xl">
        Informations d'équipement
    </div>

    <!-- Button -->
    <div class="mt-8 flex">
        <button @click="showModal = true; generateQRCode()"
            class="w-full rounded-lg border border-blue-600 bg-gradient-to-r from-blue-500 to-blue-700 px-4 py-2 text-center text-sm font-semibold text-white shadow-lg transition duration-300 ease-in-out hover:scale-105 hover:from-blue-600 hover:to-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none sm:w-auto sm:px-6 sm:py-3">
            Générer le Code-QR
        </button>
    </div>
    <br>

    <!-- Equipment Details -->
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-xl">
        <div class="grid grid-cols-1 gap-4 p-4 sm:grid-cols-2 sm:gap-6 sm:p-6 lg:grid-cols-6 lg:gap-8">
            <div class="text-sm font-semibold uppercase text-gray-500">Equipement</div>
            <div class="col-span-5 text-lg font-medium text-gray-800">{{ ucfirst($stock->name_composant) }}</div>

            <div class="text-sm font-semibold uppercase text-gray-500">Date Achat</div>
            <div class="col-span-5 text-lg text-gray-800">{{ ucfirst($stock->date_achat) }}</div>

            <div class="text-sm font-semibold uppercase text-gray-500">Prix Achat</div>
            <div class="col-span-5 text-lg text-gray-800">{{ ucfirst($stock->prix_achat) }} DH</div>

            <div class="text-sm font-semibold uppercase text-gray-500">Date Mise en service</div>
            <div class="col-span-5 text-lg text-gray-800">{{ ucfirst($stock->date_mise_en_service) }}</div>

            <div class="text-sm font-semibold uppercase text-gray-500">Caractéristique</div>
            <div class="col-span-5 space-y-1 text-lg text-gray-800">
                <div>&nbsp;{{ $stock->caractere }}</div>
                <div>&nbsp;{{ $stock->marque }}</div>
                <div>&nbsp;{{ $stock->modele }}</div>
            </div>

            <div class="text-sm font-semibold uppercase text-gray-500">Ref Interne</div>
            <div class="col-span-5 text-lg text-gray-800">{{ $stock->id_equipement }}</div>

            <div class="text-sm font-semibold uppercase text-gray-500">N° Série</div>
            <div class="col-span-5 text-lg text-gray-800">{{ $stock->serial }}</div>

            <div class="text-sm font-semibold uppercase text-gray-500">Adresse IP</div>
            <div class="col-span-5 text-lg text-gray-800">{{ $stock->address_ip }}</div>

            <div class="text-sm font-semibold uppercase text-gray-500">Société</div>
            <div class="col-span-5 text-lg text-gray-800">
                {{ $stock->societe ? $stock->societe->name : 'Société non définie' }}
            </div>

            <div class="text-sm font-semibold uppercase text-gray-500">Département</div>
            <div class="col-span-5 text-lg text-gray-800">
                {{ $stock->departement ? $stock->departement->nom_departement : 'Département non défini' }}
            </div>

            <div class="text-sm font-semibold uppercase text-gray-500">Utilisateur</div>
            <div class="col-span-5 text-lg text-gray-800">
                {{ $stock->user ? $stock->user->name : 'Utilisateur non défini' }}
            </div>

            <div class="text-sm font-semibold uppercase text-gray-500">Catégorie</div>
            <div class="col-span-5 text-lg text-gray-800">
                {{ $stock->categorystock ? $stock->categorystock->nom_categorie : 'Catégorie non définie' }}
            </div>

            <div class="text-sm font-semibold uppercase text-gray-500">Garantie</div>
            <div class="col-span-5">
                <span class="{{ $stock->garantie === 'oui' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }} inline-flex items-center gap-2 rounded-full px-3 py-1 text-sm font-semibold">
                    {{ strtoupper($stock->garantie) }}
                </span>
            </div>

            <div class="text-sm font-semibold uppercase text-gray-500">Condition</div>
            <div class="col-span-5">
                <span class="{{ 
                    $stock->condition === 'neuf' ? 'bg-blue-600 text-white' : 
                    ($stock->condition === 'bon' ? 'bg-yellow-500 text-white' : 
                    ($stock->condition === 'occasion' ? 'bg-rose-500 text-white' : 'bg-green-600 text-white'))
                }} inline-flex items-center gap-2 rounded-full px-3 py-1 text-sm font-semibold">
                    {{ strtoupper($stock->condition) }}
                </span>
            </div>

            <div class="text-sm font-semibold uppercase text-gray-500">Etat Garantie</div>
            <div class="col-span-5 text-lg text-gray-800">{{ $stock->etat_garantie }}</div>

            <div class="text-sm font-semibold uppercase text-gray-500">Ancienneté</div>
            <div class="col-span-5 text-lg text-gray-800">{{ $stock->anciennete }} Ans</div>

            <div class="text-sm font-semibold uppercase text-gray-500">Valeur Actuelle</div>
            <div class="col-span-5 text-lg text-gray-800">{{ $stock->valeur_actuelle }} DH</div>

            <div class="text-sm font-semibold uppercase text-gray-500">Commentaires</div>
            <div class="col-span-5 text-lg text-gray-800">{{ $stock->commentaire }}</div>
        </div>
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
        <div class="w-full max-w-sm rounded-xl bg-white p-6 shadow-2xl sm:max-w-md lg:max-w-lg">
            <div id="qrcode" class="mb-6"></div>
            <div class="flex justify-end gap-4">
                <button @click="printQRCode"
                    class="rounded-lg border border-blue-600 bg-blue-500 px-4 py-2 text-center text-sm font-semibold text-white shadow-lg transition duration-300 ease-in-out hover:scale-105 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none sm:px-6 sm:py-3">
                    Imprimer le Code QR
                </button>
                <button @click="showModal = false"
                    class="rounded-lg border border-red-500 bg-red-500 px-4 py-2 text-center text-sm font-semibold text-white shadow-lg transition duration-300 ease-in-out hover:scale-105 hover:bg-red-700 focus:ring-4 focus:ring-red-300 focus:outline-none sm:px-6 sm:py-3">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>



<script>
    function generateQRCode() {
        var qrCodeElement = document.getElementById('qrcode');
        qrCodeElement.innerHTML = ''; // Clear previous QR code

        // Create QR Code
        var qrcode = new QRCode(qrCodeElement, {
            text: '{{ route('stock.generate-pdf', $stock->id) }}',
            width: 256,
            height: 256,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });

        // Wait for QR Code to be generated
        setTimeout(function () {
            var canvas = qrCodeElement.getElementsByTagName('canvas')[0];
            if (!canvas) {
                console.error('QR code canvas not found');
                return;
            }
            var ctx = canvas.getContext('2d');
            var logo = new Image();
            logo.src = '{{ asset('logo-sofimed.png') }}';

            // Ensure the image loads before drawing it
            logo.onload = function () {
                var logoSize = canvas.width / 4;
                var logoPosition = (canvas.width - logoSize) / 2;
                ctx.drawImage(logo, logoPosition, logoPosition, logoSize, logoSize);
            };

            logo.onerror = function() {
                console.error('Failed to load logo image');
            };
        }, 500); // Increased timeout to ensure QR code is fully rendered
    }

    function printQRCode() {
        var node = document.getElementById('qrcode');
        domtoimage.toPng(node)
            .then(function (dataUrl) {
                var link = document.createElement('a');
                link.href = dataUrl;
                link.download = 'qrcode.png';
                link.click();
            })
            .catch(function (error) {
                console.error('Oops, something went wrong!', error);
            });
    }
</script>