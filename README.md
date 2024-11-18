# TPE WEB II Parte 3
## Integrantes: Martín Larrosa, Agustín Pietrobono.
### Base de datos relacionada a una farmacia la cual mediante clientes realizan compras de sus productos. (Medicamentos)

### API requests
- http://localhost/farmaciarest/api/compras (GET) Para obtener toda la lista de las compras.
- http://localhost/farmaciarest/api/compras/id (GET) Para obtener una compra.
- http://localhost/farmaciarest/api/compras (POST, agregar datos como formato JSON en el body) Para agregar una compra.
- http://localhost/farmaciarest/api/compras/id (PUT, agregar datos como formato JSON en el body) Para actualizar una compra.
- http://localhost/farmaciarest/api/compras?orderBy=campo (GET) Ordenar un campo.
- http://localhost/farmaciarest/api/compras?orderBy=campo&orderDirection=asc (GET) Ordenar por campo ascendente.
- http://localhost/farmaciarest/api/compras?orderBy=campo&orderDirection=desc (GET) Ordenar por campo descendente.

### Ejemplos
- http://localhost/farmaciarest/api/compras?orderBy=fecha
- http://localhost/farmaciarest/api/compras?orderBy=precio&orderDirection=desc

# DER
![Diagrama entidad relación](DIAGRAMA.png)
