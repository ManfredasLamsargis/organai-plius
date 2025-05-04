<x-layout>
    <div class="body-part-type-box-container">
        <div class="body-part-type-box info" style="border: none;">
            <h1>Body Part Offers</h1>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th style="padding: 12px; border: 1px solid #ddd;">Price (€)</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Description</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Body Part Type</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offers as $offer)
                        <tr style="text-align: center;">
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ number_format($offer->price, 2) }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ $offer->description }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ $offer->bodyPartType->name ?? 'N/A' }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">
                                <a href="{{ route('body_part.show', $offer->id) }}">
                                    <button class="crud-button show">More</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
