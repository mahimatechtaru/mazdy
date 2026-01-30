 <section class="services-section">
     <h2>Individual Service Pricing</h2>
     <div class="pricing-table-container">
         <table>
             <thead>
                 <tr>
                     <th>SERVICE NAME</th>
                     <th>DESCRIPTION</th>
                     <th>BASE PRICE</th>
                     <th>ADDITIONAL CHARGES</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($services as $service)
                     <tr>
                         <td>{{ $service->name }}</td>
                         <td>{{ $service->description }}</td>
                         <td>
                             @if ($service->base_price && $service->base_price !== 'Varies')
                                 ₹{{ number_format($service->base_price, 0) }}
                             @else
                                 {{ $service->base_price ?? 'N/A' }}
                             @endif
                         </td>
                         <td>{{ $service->additional_charges }}</td>
                     </tr>
                 @endforeach

                 @if ($services->isEmpty())
                     <tr>
                         <td colspan="4" class="text-center">Currently, no individual service pricing is available.
                         </td>
                     </tr>
                 @endif
             </tbody>
         </table>
     </div>
     <p class="disclaimer">Disclaimer: Prices may vary based on location, time of day, and specific provider. All prices
         are indicative and subject to change.</p>
 </section>

 <section class="faq-section">
     <h2>Payment Options & FAQs</h2>

     <div class="payment-options-box">
         <h3>Accepted Payment Methods</h3>
         <p>We offer a variety of convenient payment options to make your experience seamless. We accept major
             credit/debit cards, UPI payments, and popular digital wallets. For subscription plans, recurring payments
             are set up for your convenience.</p>
     </div>

     <div class="faq-container">
         @foreach ($faqs as $faq)
             <details class="faq-item">
                 <summary>
                     {{ $faq->question }} <i class="fas fa-chevron-down"></i>
                 </summary>
                 <p>{{ $faq->answer }}</p>
             </details>
         @endforeach

         @if ($faqs->isEmpty())
             <p class="text-center text-muted">No published FAQs found to display.</p>
         @endif
     </div>
 </section>
