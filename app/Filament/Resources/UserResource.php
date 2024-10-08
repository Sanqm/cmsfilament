<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Builder as ComponentsBuilder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput; // acordarse que para poder utilizar ciertos componentes los mismos deberán estar importados 
// desde la pagina de filament
use Filament\Tables\Columns\TextColumn; // idem que el anterior
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // a diferencia de los modelos que se creaban para post y comentarios  los formularios y la tabla se encuentran vacias 
    //por lo  que vamos a ir personalizandolas

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                //acordarse de que lo que introduzcamos en la función es el campo de la base de datos por lo que ha de coincidir el nombre
                ->required(), // esto indicará que a la hora de la creación este campo será de obligatorio relleno
                TextInput::make('email')
                ->email() // esto nos indica que es de tipo mail por lo que automáticamente agregará los patrones de validación pertinentes
                ->required(),
                TextInput::make('password')
                ->password()
                ->hiddenOn('edit', true) // con este método podemos indicar en que situaciones es visible para la modificación este campo en nuestro ejemplo de hoy en la edicion
                ->required(),
                Select::make('roles')->multiple()->relationship('roles', 'name') // aquei agregamos la opcion para escoger los roles 
                // con multiple indicamos que puede tener varios roles y con el tipo de relacion indicamos la tabla y el campo de la misma de donde se sacan los roles
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([   // aqui haremos que en nuestro recurso si visualicen los campos del usuario que deseo mostrar
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('email_verified_at'),
                TextColumn::make('roles.name'), // esta linea permite visualizar los roles ya que al tener una relación previamente establecida
                //accediendo a la tabla.elcampo podemos mostrar la info del mismo
            ])
            ->filters([ // aqui podemos crear filtros 
                Tables\Filters\Filter::make('verified') // estalinea agrega un campo verified 
                ->query(fn(Builder $query):Builder=>$query->whereNotNull('email_verified_at')), // y en esta le indicamos que hacer si esta seleccionado
                // 

            ])
            ->actions([ // aquí se crean los diferenctes botones que vamos a tener 
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Verify') // con esta linea agregamos un boton veriy y acontinuacion establecemos la forma del mismo
                ->icon('heroicon-m-check-badge')
                ->action(function(User $user){
                       // aquí dentro ya con código php normal puedes implementar la lógica de dicha funcion 
                    $user->email_verified_at = Date('Y-m-d H:i:s');
                    $user->save();
                    //con las lineas anteriores simplemente inidcamos que en ese usuario el campo  email verifcado de la tabla tenga la fecha actual 
                    // es muy importante no olvidarse del metodo save() al finalizar las acciones que quereamos con nuestro usuario para 
                    //que las mismas se vuelquen en la base de datos
                }), // con action podemos indicar la accion que se reaizará al clicar el boton por eso dentro 
                //le pasamos un funcion es importante que a la misma le pasemos el modelo con el que trabaja, en este caso User y el automáticamente 
                //ya sabe que se trata del usuario que se ha seleccioanado
               //******** Ahora realizaremos la accion contraria */
                Tables\Actions\Action::make('Dverify')
                ->icon('heroicon-m-x-circle')
                ->action(function(User $user){
                    $user->email_verified_at = null;
                    $user->save();
                })



               


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
