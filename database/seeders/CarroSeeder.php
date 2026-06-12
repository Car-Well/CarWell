<?php

namespace Database\Seeders;

use App\Models\Carro;
use Illuminate\Database\Seeder;

class CarroSeeder extends Seeder
{
    public function run()
    {
        $carros = [

            // ── Populares ──────────────────────────────────────────────────

            [
                'marca' => 'Volkswagen', 'modelo' => 'Gol', 'ano' => 2019,
                'cor' => 'Branco', 'km' => 48000, 'preco' => 52000,
                'combustivel' => 'flex', 'cambio' => 'manual',
                'status' => 'disponivel', 'categoria' => 'hatchback',
                'destacado' => false,
                'descricao' => 'Clássico compacto com excelente custo-benefício, ideal para o dia a dia urbano.',
            ],
            [
                'marca' => 'Volkswagen', 'modelo' => 'T-Cross', 'ano' => 2022,
                'cor' => 'Cinza', 'km' => 18000, 'preco' => 145000,
                'combustivel' => 'flex', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'suv',
                'destacado' => true,
                'descricao' => 'SUV compacto com design moderno, central multimídia touchscreen e câmera de ré.',
            ],
            [
                'marca' => 'Volkswagen', 'modelo' => 'Polo', 'ano' => 2023,
                'cor' => 'Prata', 'km' => 6000, 'preco' => 118000,
                'combustivel' => 'flex', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'hatchback',
                'destacado' => false,
                'descricao' => 'Hatch premium com acabamento refinado, controle de estabilidade e assistente de frenagem.',
            ],
            [
                'marca' => 'Chevrolet', 'modelo' => 'Onix', 'ano' => 2022,
                'cor' => 'Vermelho', 'km' => 22000, 'preco' => 98000,
                'combustivel' => 'flex', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'hatchback',
                'destacado' => false,
                'descricao' => 'O hatch mais vendido do Brasil, com Wi-Fi de bordo e excelente eficiência de combustível.',
            ],
            [
                'marca' => 'Chevrolet', 'modelo' => 'Tracker', 'ano' => 2023,
                'cor' => 'Azul', 'km' => 9000, 'preco' => 155000,
                'combustivel' => 'flex', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'suv',
                'destacado' => true,
                'descricao' => 'SUV moderno com motor turbo, teto solar panorâmico e sistema OnStar integrado.',
            ],
            [
                'marca' => 'Chevrolet', 'modelo' => 'S10', 'ano' => 2021,
                'cor' => 'Preto', 'km' => 35000, 'preco' => 210000,
                'combustivel' => 'diesel', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'pickup',
                'destacado' => false,
                'descricao' => 'Picape robusta com tração 4x4, suspensão reforçada e capacidade de carga de 1 tonelada.',
            ],
            [
                'marca' => 'Fiat', 'modelo' => 'Argo', 'ano' => 2023,
                'cor' => 'Branco', 'km' => 3000, 'preco' => 89000,
                'combustivel' => 'flex', 'cambio' => 'manual',
                'status' => 'disponivel', 'categoria' => 'hatchback',
                'destacado' => false,
                'descricao' => 'Hatch com visual esportivo, câmbio preciso e excelente dirigibilidade.',
            ],
            [
                'marca' => 'Fiat', 'modelo' => 'Pulse', 'ano' => 2022,
                'cor' => 'Laranja', 'km' => 15000, 'preco' => 138000,
                'combustivel' => 'flex', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'suv',
                'destacado' => false,
                'descricao' => 'SUV compacto com motor turbo 1.0, teto solar e sistema de infotainment de 10 polegadas.',
            ],
            [
                'marca' => 'Fiat', 'modelo' => 'Strada', 'ano' => 2022,
                'cor' => 'Cinza', 'km' => 28000, 'preco' => 102000,
                'combustivel' => 'flex', 'cambio' => 'manual',
                'status' => 'disponivel', 'categoria' => 'pickup',
                'destacado' => false,
                'descricao' => 'A picape mais vendida do Brasil, versátil para trabalho e lazer com cabine dupla.',
            ],
            [
                'marca' => 'Toyota', 'modelo' => 'Corolla', 'ano' => 2022,
                'cor' => 'Prata', 'km' => 20000, 'preco' => 185000,
                'combustivel' => 'hibrido', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'sedan',
                'destacado' => true,
                'descricao' => 'Sedan híbrido com tecnologia Toyota Hybrid System, economia de combustível excepcional e acabamento premium.',
            ],
            [
                'marca' => 'Toyota', 'modelo' => 'Hilux', 'ano' => 2023,
                'cor' => 'Preto', 'km' => 8000, 'preco' => 295000,
                'combustivel' => 'diesel', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'pickup',
                'destacado' => true,
                'descricao' => 'A picape líder em vendas, invencível fora de estrada com tração 4x4 permanente e motor 2.8 turbo diesel.',
            ],
            [
                'marca' => 'Toyota', 'modelo' => 'Yaris', 'ano' => 2022,
                'cor' => 'Azul', 'km' => 24000, 'preco' => 112000,
                'combustivel' => 'flex', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'hatchback',
                'destacado' => false,
                'descricao' => 'Hatch japonês com confiabilidade Toyota, airbags frontais e laterais e controle de tração.',
            ],
            [
                'marca' => 'Honda', 'modelo' => 'Civic', 'ano' => 2023,
                'cor' => 'Branco', 'km' => 5000, 'preco' => 198000,
                'combustivel' => 'flex', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'sedan',
                'destacado' => true,
                'descricao' => 'Sedan esportivo com motor 1.5 turbo, painel digital e sistema Honda Sensing de segurança ativa.',
            ],
            [
                'marca' => 'Honda', 'modelo' => 'HR-V', 'ano' => 2022,
                'cor' => 'Vermelho', 'km' => 17000, 'preco' => 168000,
                'combustivel' => 'flex', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'suv',
                'destacado' => false,
                'descricao' => 'SUV compacto com interior espaçoso, banco traseiro Magic Seat e excelente acabamento.',
            ],
            [
                'marca' => 'Honda', 'modelo' => 'City', 'ano' => 2021,
                'cor' => 'Prata', 'km' => 31000, 'preco' => 118000,
                'combustivel' => 'flex', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'sedan',
                'destacado' => false,
                'descricao' => 'Sedan compacto com porta-malas generoso, painel elegante e direção elétrica precisa.',
            ],
            [
                'marca' => 'Hyundai', 'modelo' => 'HB20', 'ano' => 2022,
                'cor' => 'Amarelo', 'km' => 19000, 'preco' => 82000,
                'combustivel' => 'flex', 'cambio' => 'manual',
                'status' => 'disponivel', 'categoria' => 'hatchback',
                'destacado' => false,
                'descricao' => 'Hatch nacional com design arrojado, central multimídia com Apple CarPlay e Android Auto.',
            ],
            [
                'marca' => 'Hyundai', 'modelo' => 'Creta', 'ano' => 2023,
                'cor' => 'Cinza', 'km' => 7000, 'preco' => 162000,
                'combustivel' => 'flex', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'suv',
                'destacado' => false,
                'descricao' => 'SUV com teto solar, suspensão independente nas 4 rodas e motor 1.0 turbo de alta performance.',
            ],
            [
                'marca' => 'Jeep', 'modelo' => 'Compass', 'ano' => 2022,
                'cor' => 'Preto', 'km' => 23000, 'preco' => 225000,
                'combustivel' => 'flex', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'suv',
                'destacado' => false,
                'descricao' => 'SUV médio com capacidade off-road, tração 4x4 inteligente e acabamento premium.',
            ],
            [
                'marca' => 'Jeep', 'modelo' => 'Renegade', 'ano' => 2021,
                'cor' => 'Verde', 'km' => 38000, 'preco' => 175000,
                'combustivel' => 'flex', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'suv',
                'destacado' => false,
                'descricao' => 'SUV compacto aventureiro com design icônico, motor turbo e muito espaço interno.',
            ],
            [
                'marca' => 'Renault', 'modelo' => 'Kwid', 'ano' => 2022,
                'cor' => 'Branco', 'km' => 25000, 'preco' => 72000,
                'combustivel' => 'flex', 'cambio' => 'manual',
                'status' => 'disponivel', 'categoria' => 'hatchback',
                'destacado' => false,
                'descricao' => 'Hatch acessível com estilo crossover, câmera de ré e excelente economia de combustível.',
            ],
            [
                'marca' => 'Ford', 'modelo' => 'Ranger', 'ano' => 2022,
                'cor' => 'Prata', 'km' => 29000, 'preco' => 265000,
                'combustivel' => 'diesel', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'pickup',
                'destacado' => false,
                'descricao' => 'Picape robusta com motor biturbo, assistência na descida de rampa e SYNC 4 com tela de 12 polegadas.',
            ],
            [
                'marca' => 'Nissan', 'modelo' => 'Kicks', 'ano' => 2022,
                'cor' => 'Azul', 'km' => 16000, 'preco' => 148000,
                'combustivel' => 'flex', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'suv',
                'destacado' => false,
                'descricao' => 'SUV com visual arrojado, teto bicolor, câmera 360° e assistente de permanência em faixa.',
            ],

            // ── Premium ────────────────────────────────────────────────────

            [
                'marca' => 'BMW', 'modelo' => 'X1', 'ano' => 2022,
                'cor' => 'Branco', 'km' => 14000, 'preco' => 285000,
                'combustivel' => 'gasolina', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'suv',
                'destacado' => true,
                'descricao' => 'SUV premium com motor TwinPower Turbo, painel curvo BMW iDrive 8 e suspensão adaptativa.',
            ],
            [
                'marca' => 'BMW', 'modelo' => 'Série 3', 'ano' => 2023,
                'cor' => 'Azul', 'km' => 4000, 'preco' => 345000,
                'combustivel' => 'gasolina', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'sedan',
                'destacado' => true,
                'descricao' => 'Sedan esportivo referência em dinâmica de condução, com câmbio Steptronic de 8 velocidades e interior luxuoso.',
            ],
            [
                'marca' => 'Mercedes-Benz', 'modelo' => 'GLA 200', 'ano' => 2022,
                'cor' => 'Preto', 'km' => 11000, 'preco' => 320000,
                'combustivel' => 'gasolina', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'suv',
                'destacado' => true,
                'descricao' => 'SUV compacto com o DNA Mercedes, interior com MBUX, tela de 10 polegadas e acabamento de altíssimo nível.',
            ],
            [
                'marca' => 'Mercedes-Benz', 'modelo' => 'C 300', 'ano' => 2023,
                'cor' => 'Prata', 'km' => 2000, 'preco' => 398000,
                'combustivel' => 'gasolina', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'sedan',
                'destacado' => true,
                'descricao' => 'Sedan executivo de nova geração com MBUX Hyperscreen, suspensão aerodinâmica ativa e motor 2.0 turbo de 258 cv.',
            ],
            [
                'marca' => 'Audi', 'modelo' => 'Q3', 'ano' => 2022,
                'cor' => 'Cinza', 'km' => 13000, 'preco' => 295000,
                'combustivel' => 'gasolina', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'suv',
                'destacado' => false,
                'descricao' => 'SUV premium com Virtual Cockpit, quattro all-wheel drive e iluminação interna de ambientação.',
            ],
            [
                'marca' => 'Audi', 'modelo' => 'A4', 'ano' => 2021,
                'cor' => 'Branco', 'km' => 27000, 'preco' => 328000,
                'combustivel' => 'gasolina', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'sedan',
                'destacado' => false,
                'descricao' => 'Sedan alemão com Virtual Cockpit Plus, motor TFSI de 190 cv e suspensão pneumática opcional.',
            ],
            [
                'marca' => 'Porsche', 'modelo' => 'Cayenne', 'ano' => 2022,
                'cor' => 'Preto', 'km' => 10000, 'preco' => 695000,
                'combustivel' => 'gasolina', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'suv',
                'destacado' => true,
                'descricao' => 'SUV esportivo lendário com motor V6 biturbo de 340 cv, suspensão a ar e Porsche Communication Management.',
            ],
            [
                'marca' => 'Porsche', 'modelo' => '911 Carrera', 'ano' => 2023,
                'cor' => 'Vermelho', 'km' => 1500, 'preco' => 895000,
                'combustivel' => 'gasolina', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'esportivo',
                'destacado' => true,
                'descricao' => 'O esportivo mais icônico do mundo, com motor boxer 3.0 biturbo de 385 cv e 0 a 100 km/h em 4,2 segundos.',
            ],

            // ── Superesportivos ────────────────────────────────────────────

            [
                'marca' => 'Ferrari', 'modelo' => '488 GTB', 'ano' => 2020,
                'cor' => 'Vermelho', 'km' => 8000, 'preco' => 2800000,
                'combustivel' => 'gasolina', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'esportivo',
                'destacado' => true,
                'descricao' => 'Lenda de Maranello com motor V8 biturbo de 670 cv, F1-Trac e diferencial eletrônico E-Diff3. 0-100 km/h em 3,0 segundos.',
            ],
            [
                'marca' => 'Ferrari', 'modelo' => 'Roma', 'ano' => 2022,
                'cor' => 'Cinza', 'km' => 3000, 'preco' => 3200000,
                'combustivel' => 'gasolina', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'esportivo',
                'destacado' => true,
                'descricao' => 'Grand Tourer italiano com design atemporal, motor V8 biturbo de 620 cv e habitáculo 2+2 ultra sofisticado.',
            ],
            [
                'marca' => 'Lamborghini', 'modelo' => 'Huracán EVO', 'ano' => 2021,
                'cor' => 'Amarelo', 'km' => 5000, 'preco' => 3500000,
                'combustivel' => 'gasolina', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'esportivo',
                'destacado' => true,
                'descricao' => 'Supercar com motor V10 aspirado de 640 cv, tração integral e sistema LDVI para controle dinâmico total.',
            ],
            [
                'marca' => 'McLaren', 'modelo' => '720S', 'ano' => 2021,
                'cor' => 'Laranja', 'km' => 6500, 'preco' => 2900000,
                'combustivel' => 'gasolina', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'esportivo',
                'destacado' => true,
                'descricao' => 'Hipercarro britânico com carroceria de fibra de carbono, motor V8 biturbo de 720 cv e 0-100 km/h em 2,9 segundos.',
            ],
            [
                'marca' => 'Rolls-Royce', 'modelo' => 'Ghost', 'ano' => 2022,
                'cor' => 'Preto', 'km' => 4000, 'preco' => 4800000,
                'combustivel' => 'gasolina', 'cambio' => 'automatico',
                'status' => 'disponivel', 'categoria' => 'sedan',
                'destacado' => true,
                'descricao' => 'O epítome do luxo britânico com motor V12 biturbo de 571 cv, teto Starlight com 1.340 fibras ópticas e silêncio absoluto.',
            ],
        ];

        foreach ($carros as $carro) {
            Carro::create($carro);
        }
    }
}
