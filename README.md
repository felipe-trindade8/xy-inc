## xy-inc
Repository of API development test for registration and search of points of interest (POI).

### Test Description

A XY Inc. é uma empresa especializada na produção de excelentes receptores GPS (Global
Positioning System). A diretoria está empenhada em lançar um dispositivo inovador que
promete auxiliar pessoas na localização de ponto de interesse (POIs), e precisa muito de sua
ajuda.
Você foi contratado para desenvolver a plataforma que fornecerá toda a inteligência ao
dispositivo. Esta plataforma deve ser baseada em serviços, de forma a flexibilizar a integração, sendo
estes:
Serviço para cadastrar pontos de interesse com 3 atributos: Nome do POI, Coordenada X (inteiro não
negativo) Coordenada Y (inteiro não negativo). Os POIs devem ser armazenados em uma base de dados.
Serviço para listar todos os POIs cadastrados.
Serviço para listar POIs por proximidade. Este serviço receberá uma coordenada X e uma c
oordenada Y, especificando um ponto de referência, em como uma distância máxima (dmax)
em metros. O serviço deverá retornar todos os POIs da base de dados que estejam a uma distância
menor ou igual a d-max a partir do ponto de referência. Exemplo:
Base de Dados:
'Lanchonete' (x=27, y=12)
'Posto' (x=31, y=18)
'Joalheria' (x=15, y=12)
'Floricultura' (x=19, y=21)
'Pub' (x=12, y=8)
'Supermercado' (x=23, y=6)
'Churrascaria' (x=28, y=2)
Dado o ponto de referência (x=20, y=10) indicado pelo receptor GPS, e uma distância máxima de 10
metros, o serviço deve retornar os seguintes POIs:
Lanchonete
Joalheria
Pub
Supermercado
O que deve ser feito:
Faça um planejamento e nos informe quando conseguirá entregar o teste.
Construa os 3 serviços especificados
O código-fonte deve ser disponibilizado na sua conta do Github, em um repositório com o
nome xy-inc, juntamente com as instruções para execução e testes da aplicação (arquivo README)

### Requirements

PHP 7.0+
MySql 5.0+
Git

### Download

	$ git clone https://github.com/felipe-trindade8/xy-inc.git

### Build Setup

    $ php artisan migrate

### Using API

Saving a new POI
 
	 Method: POST
	 URI: /api/poi
	 data: {
	      name         : String
	      coordinate_x : number
	      coordinate_y : number
	 }


Listing all POI register

	Method: GET
	URI: /api/poi


Find all POI register by proximity using haversine formula
 
	 Method: GET
	 URI: /api/poi/find/{dmax}/{coordinate_x}/{coordinate_y}
	 
	 Example: http://localhost/api/poi/find/10/20/10
	
 

Updating a POI
 
	Method: PUT
	URI: /api/poi/{id}
	data: {
	      name         : String
	      coordinate_x : number
	      coordinate_y : number
	}
	
	
 Remove a POI
 
	 Method: DELETE
	 URI: /api/poi/{id}
 

### Applications definitions

 It was developed with PHP 7.0 + Laravel 5.4 and MySql 5.0
 
 To test application, it was used PHPUnit.
 Follow the UnitTests:
 
	- Save POI with success;
	- List all POI registered;
	- Find all POI registered by proximity using haversine formula