<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseOrderResource\Pages;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers;
use App\Models\PurchaseOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use App\Models\Customer;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action as NotificationAction;

class PurchaseOrderResource extends Resource
{
    protected static ?string $model = PurchaseOrder::class;
    protected static ?string $navigationGroup = 'Orders';
    protected static ?string $navigationIcon = 'carbon-purchase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Select::make('customer_id')
                    ->label('Customer')
                    ->options(Customer::all()->pluck('name', 'id'))
                    ->searchable(),
                TextInput::make('reference'),
                DatePicker::make('expected_date_arrival')->displayFormat('d/m/Y'),
                TimePicker::make('expected_time_arrival')->seconds(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reference')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_approved')
                    ->boolean()
                    ->label('Status')
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark')

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                //Tables\Actions\CreateAction::make(),
                //Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Approve')
                    ->label('Approve')
                    ->requiresConfirmation()
                    ->action(
                        function ($action, PurchaseOrder $record) {
                            if ($record->has('products')->count() <= 0 ) {
                                // Runs before the form fields are saved to the database.

$recipient = auth()->user();


                                Notification::make()
                                ->title('There are no products attached.')
                                ->danger()
                                ->duration(15000)
                                ->body('Please, attach products to the purchase order.')
                                ->actions([
                                    NotificationAction::make('View Order')
                                        ->button()
                                        ->markAsRead()
                                        ->url(route(  'filament.admin.resources.purchase-orders.edit',  $record->id )),
                                ])
                                ->sendToDatabase($recipient)
                                ->send();
                                $action->cancel();
                            }
                        }
                    )

                //->url(fn (): string => route('posts.edit', ['post' => $this->post]))

            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPurchaseOrders::route('/'),
            'create' => Pages\CreatePurchaseOrder::route('/create'),
            'edit' => Pages\EditPurchaseOrder::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
