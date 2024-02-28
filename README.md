
# Product API Test

Este proyecto es la resolución de una prueba técina implementando arquitectura hexagonal y diseño orientado al dominio (DDD) sobre Symfony 6.4 (LTS)

## Notas para los evaluadores

#### Acerca del proyecto y su estructura
* Se identificaron dos entidades escenciales *Product* y *User* (para la autenticación)
* Para la gestión de cada entidad/agregado se creó un directorio: *Product* y *Auth* (para *User*), cada uno con *Dominio, Application, Infrastructure*
* **Dominio**: Completamente independiente y desconectado de las capas superiores, incluso desconectado del *ORM*. Contiene definición de clases y métodos escenciales.
* **Application** Depende del *Dominio* pero no de la capa *Infrastructure*. Contiene clases que ejecutan casos de uso: *CreateProduct, GetProduct, GetProductList, SaveUser*. Esta lógica es llamada y usada desde los controladores de la capa *Infrastructure*.
* **Infrastructure**: En esta capa se implementan funcionalidades, clases y métodos del framework Symfony y de las capas internas. Aquí se encuentran, entre otros, los Controladores y el mapeo de las entidades del Dominio para el *ORM*

#### Alcance
* Fixtures para carge de datos iniciales
  * Un usuario *admin*
  * 17 productos
* **API para autenticación de usuario** *admin* que retorna un *JWT* necesario para las usar las APIs de productos enviándolo en la cabecera como "Authorization: Bearer ***"
```
curl --location 'https://127.0.0.1:8000/api/login_check' \
--header 'Content-Type: application/json' \
--data '{
  "username": "admin",
  "password": "Pa55w0rd"
}'
```
* **API Post para creación** de proyecto
```
curl --location 'https://127.0.0.1:8000/api/products' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer ***' \
--data '{
  "name": "Licensed Rubber Mouse",
  "description": "Descripción del producto ...",
  "price": "576.61",
  "vatRate": "10"
}'
```
* **API Get para consulta de un** proyecto
```
curl --location 'https://127.0.0.1:8000/api/products/1' \
--header 'Authorization: Bearer ***'
```
* **API GetAll para obtener lista** de proyectos *paginados* con opción de filtro por nombre de proyecto enviado el *queryParam* "name"
```
curl --location 'https://127.0.0.1:8000/api/products?limit=5&page=2' \
--header 'Authorization: Bearer ***'
```
* **Test unitarios** para creación y consulta de productos

#### Aspectos omitidos o fuera del alcance
* Uso de *ValueObjects* en el *Dominio*
* Uso de *CQRS*
* Declaración de un controlador por cada caso de uso
