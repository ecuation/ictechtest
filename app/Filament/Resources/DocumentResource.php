<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;


class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('priority')
                    ->required()
                    ->label('priority')
                    ->options([
                        'high' => 'high',
                        'medium' => 'medium',
                        'low' => 'low'
                    ]),
                Forms\Components\DatePicker::make('approved_at'),
                Forms\Components\FileUpload::make('file')
                    ->previewable()
                    ->directory('documents')
                    ->storeFileNamesIn('documents')
                    ->openable()
                    ->downloadable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('approved_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('priority')
                    ->options([
                        'high' => 'high',
                        'medium' => 'medium',
                        'low' => 'low'
                    ])
                    ->disabled()
                    ->selectablePlaceholder(false),
                Tables\Columns\TextColumn::make('file')
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
                SelectFilter::make('priority')
                    ->options([
                        'high' => 'high',
                        'medium' => 'medium',
                        'low' => 'low'
                    ]),
                Filter::make('approved_at')
                    ->form([
                        Forms\Components\DatePicker::make('approved_from'),
                        Forms\Components\DatePicker::make('approved_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['approved_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('approved_at', '>=', $date),
                            )
                            ->when(
                                $data['approved_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('approved_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
            'view' => Pages\ViewDocument::route('/{record}'),
        ];
    }
}
