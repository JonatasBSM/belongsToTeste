<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CidadeResource\Pages;
use App\Filament\Resources\CidadeResource\RelationManagers;
use App\Models\Cidade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CidadeResource extends Resource
{
    protected static ?string $model = Cidade::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->label('Nome da Cidade')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Group::make()
                ->relationship('estado')
                ->schema([
                    Forms\Components\TextInput::make('nome')
                        ->label('Nome do Estado')
                        ->required(),
                    Forms\Components\Group::make()
                        ->relationship('pais')
                        ->label('Nome do País')
                        ->schema([
                            Forms\Components\TextInput::make('nome')
                                ->required(),
                        ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCidades::route('/'),
            'create' => Pages\CreateCidade::route('/create'),
            'edit' => Pages\EditCidade::route('/{record}/edit'),
        ];
    }
}
