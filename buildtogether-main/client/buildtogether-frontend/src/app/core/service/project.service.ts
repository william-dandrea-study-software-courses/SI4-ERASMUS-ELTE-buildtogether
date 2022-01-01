import { Injectable } from '@angular/core';
import {Post} from "../../shared/models/post.model";
import {BehaviorSubject} from "rxjs";
import {Project} from "../../shared/models/project.model";
import {HttpClient} from "@angular/common/http";
import {GET_ALL_PROJECTS} from "../../../assets/routes.constants";

@Injectable({
  providedIn: 'root'
})
export class ProjectService {

  public allProjects: Project[] | null = null;
  public allProjects$: BehaviorSubject<Project[] | null> = new BehaviorSubject<Project[] | null>(null)

  constructor(private http: HttpClient) {
    this.initializeAllProjects();
  }

  private initializeAllProjects(): void {

    this.http.get<Project[]>(GET_ALL_PROJECTS).subscribe(
      data => {

        this.allProjects = data;
        this.allProjects$.next(this.allProjects);

      }, error => {
        console.log(error);
      }
    )


  }

}
