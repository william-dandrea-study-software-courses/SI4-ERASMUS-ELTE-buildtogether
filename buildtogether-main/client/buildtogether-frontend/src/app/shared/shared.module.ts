import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import { MenuBarComponent } from './components/menu-bar/menu-bar.component';
import {MatIconModule} from '@angular/material/icon';
import {MatProgressSpinnerModule} from "@angular/material/progress-spinner";
import { MoneySliderComponent } from './components/money-slider/money-slider.component';


const modules = [
  CommonModule,
  ReactiveFormsModule,
  FormsModule,
  MatIconModule,
  MatProgressSpinnerModule
];

const components = [
  MenuBarComponent
];



@NgModule({
  declarations: [
    ...components,
    MenuBarComponent,
    MoneySliderComponent,
  ],
  imports: [
    ...modules
  ],
  exports: [
    ...modules,
    ...components,
    MoneySliderComponent,
  ]
})
export class SharedModule {
  static forRoot() {
    return {
      ngModule: SharedModule,
      providers: []
    }
  }
}
